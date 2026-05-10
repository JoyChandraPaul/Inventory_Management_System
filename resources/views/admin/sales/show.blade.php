@extends('layouts.admin')

@section('page_title', 'Invoice')

@section('content')
    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3 no-print">
        <a href="{{ route('sales.index') }}" class="btn btn-link px-0">&larr; Back</a>
        <button class="btn btn-outline-secondary" type="button" onclick="window.print()">Print</button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="fw-semibold">Shopno</div>
                    <div class="text-secondary small">Invoice</div>
                </div>
                <div class="text-end">
                    <div class="font-monospace fw-semibold">{{ $sale->invoice_no }}</div>
                    <div class="text-secondary small">{{ $sale->sale_date?->format('Y-m-d H:i') }}</div>
                </div>
            </div>

            <div class="mb-3">
                <div class="text-secondary small">Bill To</div>
                <div class="fw-semibold">{{ $sale->customer?->name }}</div>
                <div class="small text-secondary">{{ $sale->customer?->phone }} @if($sale->customer?->email) • {{ $sale->customer->email }} @endif</div>
                @if($sale->customer?->address)
                    <div class="small">{{ $sale->customer->address }}</div>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="width: 140px;" class="text-end">Unit Price</th>
                            <th style="width: 100px;" class="text-end">Qty</th>
                            <th style="width: 160px;" class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item->product?->name }}</div>
                                    <div class="text-secondary small font-monospace">{{ $item->product?->sku }}</div>
                                </td>
                                <td class="text-end font-monospace">{{ number_format((float)$item->unit_price, 2) }}</td>
                                <td class="text-end font-monospace">{{ number_format($item->quantity) }}</td>
                                <td class="text-end font-monospace">{{ number_format((float)$item->line_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Subtotal</th>
                            <th class="text-end font-monospace">{{ number_format((float)$sale->subtotal, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Discount</th>
                            <th class="text-end font-monospace">{{ number_format((float)$sale->discount, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Grand Total</th>
                            <th class="text-end font-monospace">{{ number_format((float)$sale->grand_total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

