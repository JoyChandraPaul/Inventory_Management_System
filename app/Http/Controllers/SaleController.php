<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $q = request()->string('q')->trim()->value();
        $customerId = request()->integer('customer_id') ?: null;
        $from = request()->string('from')->trim()->value();
        $to = request()->string('to')->trim()->value();

        $sales = Sale::query()
            ->with('customer')
            ->when($q !== '', fn ($query) => $query->where('invoice_no', 'like', "%{$q}%"))
            ->when($customerId, fn ($query) => $query->where('customer_id', $customerId))
            ->when($from !== '', fn ($query) => $query->whereDate('sale_date', '>=', $from))
            ->when($to !== '', fn ($query) => $query->whereDate('sale_date', '<=', $to))
            ->orderByDesc('sale_date')
            ->paginate(10)
            ->withQueryString();

        $customers = Customer::orderBy('name')->get();

        return view('admin.sales.index', compact('sales', 'customers', 'q', 'customerId', 'from', 'to'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers = Customer::orderBy('name')->get();
        $products = Product::query()
            ->with('category')
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $discount = (float) ($data['discount'] ?? 0);

        $requestedItems = collect($data['items'])
            ->groupBy('product_id')
            ->map(fn ($rows) => (int) collect($rows)->sum('quantity'));

        $sale = DB::transaction(function () use ($data, $discount, $requestedItems) {
            $products = Product::query()
                ->whereIn('id', $requestedItems->keys())
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $itemsToCreate = [];
            $subtotal = 0.0;

            foreach ($requestedItems as $productId => $qty) {
                /** @var \App\Models\Product|null $product */
                $product = $products->get((int) $productId);

                if (! $product || ! $product->status) {
                    abort(422, 'One or more selected products are unavailable.');
                }

                if ($qty > $product->stock_qty) {
                    abort(422, "Not enough stock for {$product->name} (available: {$product->stock_qty}).");
                }

                $unitPrice = (float) $product->price;
                $lineTotal = $unitPrice * $qty;
                $subtotal += $lineTotal;

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'unit_price' => $unitPrice,
                    'quantity' => $qty,
                    'line_total' => $lineTotal,
                ];
            }

            $grandTotal = max(0, $subtotal - $discount);

            $sale = Sale::create([
                'customer_id' => $data['customer_id'],
                'invoice_no' => $this->generateInvoiceNo(),
                'sale_date' => isset($data['sale_date']) ? Carbon::parse($data['sale_date']) : now(),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'grand_total' => $grandTotal,
            ]);

            $sale->items()->createMany($itemsToCreate);

            foreach ($requestedItems as $productId => $qty) {
                Product::whereKey((int) $productId)->decrement('stock_qty', $qty);
            }

            return $sale;
        });

        return redirect()
            ->route('sales.show', $sale)
            ->with('status', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): View
    {
        $sale->load(['customer', 'items.product']);

        return view('admin.sales.show', compact('sale'));
    }

    private function generateInvoiceNo(): string
    {
        return 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
