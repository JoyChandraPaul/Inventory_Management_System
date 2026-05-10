@extends('layouts.admin')

@section('page_title', 'Create Sale')

@section('content')
    <div class="mb-3">
        <a href="{{ route('sales.index') }}" class="btn btn-link px-0">&larr; Back</a>
    </div>

    <form method="POST" action="{{ route('sales.store') }}" class="vstack gap-3">
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                <div class="fw-semibold mb-1">Please fix the errors below.</div>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="customer_id">Customer</label>
                        <select id="customer_id" name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
                            <option value="" disabled @selected(old('customer_id') === null)>Select customer</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}" @selected((int)old('customer_id') === $c->id)>
                                    {{ $c->name }} ({{ $c->phone }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label" for="sale_date">Sale Date</label>
                        <input id="sale_date" type="datetime-local" name="sale_date" value="{{ old('sale_date') }}" class="form-control @error('sale_date') is-invalid @enderror">
                        @error('sale_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label" for="discount">Discount</label>
                        <input id="discount" type="number" step="0.01" min="0" name="discount" value="{{ old('discount', 0) }}" class="form-control @error('discount') is-invalid @enderror">
                        @error('discount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="fw-semibold">Items</div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addRowBtn">Add Product</button>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle" id="itemsTable">
                        <thead>
                            <tr>
                                <th style="width: 45%;">Product</th>
                                <th style="width: 15%;" class="text-end">Unit Price</th>
                                <th style="width: 15%;">Qty</th>
                                <th style="width: 15%;" class="text-end">Line Total</th>
                                <th style="width: 10%;" class="text-end">Remove</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal</th>
                                <th class="text-end font-monospace" id="subtotalCell">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Discount</th>
                                <th class="text-end font-monospace" id="discountCell">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Grand Total</th>
                                <th class="text-end font-monospace" id="grandTotalCell">0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Create Sale</button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    const products = {!! \Illuminate\Support\Js::from(
        $products->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'sku' => $p->sku,
                'price' => (float) $p->price,
                'stock_qty' => (int) $p->stock_qty,
            ];
        })->values()
    ) !!};

    const tbody = document.querySelector('#itemsTable tbody');
    const addRowBtn = document.getElementById('addRowBtn');
    const discountInput = document.getElementById('discount');

    let rowIndex = 0;

    function money(n) {
        return (Math.round((Number(n) + Number.EPSILON) * 100) / 100).toFixed(2);
    }

    function recalc() {
        let subtotal = 0;
        tbody.querySelectorAll('tr').forEach((tr) => {
            const price = Number(tr.querySelector('[data-unit-price]').value || 0);
            const qty = Number(tr.querySelector('[data-qty]').value || 0);
            const line = price * qty;
            tr.querySelector('[data-line-total]').textContent = money(line);
            subtotal += line;
        });

        const discount = Number(discountInput.value || 0);
        const grand = Math.max(0, subtotal - discount);

        document.getElementById('subtotalCell').textContent = money(subtotal);
        document.getElementById('discountCell').textContent = money(discount);
        document.getElementById('grandTotalCell').textContent = money(grand);
    }

    function addRow(productId = '') {
        const tr = document.createElement('tr');

        const index = rowIndex++;

        const productOptions = [
            `<option value="" disabled ${productId ? '' : 'selected'}>Select product</option>`,
            ...products.map(p => {
                const label = `${p.name} (${p.sku}) - Stock: ${p.stock_qty}`;
                return `<option value="${p.id}" ${String(p.id) === String(productId) ? 'selected' : ''}>${label}</option>`;
            })
        ].join('');

        tr.innerHTML = `
            <td>
                <select class="form-select" name="items[${index}][product_id]" data-product required>
                    ${productOptions}
                </select>
            </td>

            <td>
                <input class="form-control text-end font-monospace"
                       data-unit-price
                       type="number"
                       step="0.01"
                       min="0"
                       value="0.00"
                       readonly>
            </td>

            <td>
                <input class="form-control"
                       data-qty
                       name="items[${index}][quantity]"
                       type="number"
                       min="1"
                       value="1"
                       required>
            </td>

            <td class="text-end font-monospace" data-line-total>0.00</td>

            <td class="text-end">
                <button type="button" class="btn btn-sm btn-outline-danger" data-remove>Remove</button>
            </td>
        `;

        tr.querySelector('[data-remove]').addEventListener('click', () => {
            tr.remove();
            recalc();
        });

        const productSelect = tr.querySelector('[data-product]');
        const unitPriceInput = tr.querySelector('[data-unit-price]');
        const qtyInput = tr.querySelector('[data-qty]');

        function syncFromProduct() {
            const id = productSelect.value;
            const p = products.find(x => String(x.id) === String(id));

            if (!p) {
                unitPriceInput.value = '0.00';
                return recalc();
            }

            unitPriceInput.value = money(p.price);
            qtyInput.max = String(p.stock_qty || 0);

            if (Number(qtyInput.value) > Number(qtyInput.max)) {
                qtyInput.value = qtyInput.max || '1';
            }

            recalc();
        }

        productSelect.addEventListener('change', syncFromProduct);
        qtyInput.addEventListener('input', recalc);

        tbody.appendChild(tr);
        syncFromProduct();
    }

    addRowBtn.addEventListener('click', () => addRow());
    discountInput.addEventListener('input', recalc);

    addRow();
    recalc();
</script>
@endpush

