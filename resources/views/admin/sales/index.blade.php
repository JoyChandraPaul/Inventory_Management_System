@extends('layouts.admin')

@section('page_title', 'Sales')

@section('content')
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <form method="GET" action="{{ route('sales.index') }}" class="flex-grow-1">
                    <div class="row g-2 align-items-end">
                        <div class="col-12 col-md-3">
                            <label class="form-label mb-1">Invoice No</label>
                            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search invoice...">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label mb-1">Customer</label>
                            <select class="form-select" name="customer_id">
                                <option value="">All Customers</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" @selected((int)$customerId === $c->id)>{{ $c->name }} ({{ $c->phone }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-md-2">
                            <label class="form-label mb-1">From</label>
                            <input type="date" name="from" value="{{ $from }}" class="form-control" />
                        </div>

                        <div class="col-6 col-md-2">
                            <label class="form-label mb-1">To</label>
                            <input type="date" name="to" value="{{ $to }}" class="form-control" />
                        </div>

                        <div class="col-12 col-md-1 d-grid">
                            <button class="btn btn-outline-secondary" type="submit">Go</button>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center gap-2">
                                @if($q !== '' || $customerId || $from !== '' || $to !== '')
                                    <a class="btn btn-link px-0" href="{{ route('sales.index') }}">Clear filters</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                <div class="ms-md-3">
                    <a class="btn btn-primary" href="{{ route('sales.create') }}">Create Sale</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 200px;">Invoice</th>
                        <th>Customer</th>
                        <th style="width: 200px;">Date</th>
                        <th style="width: 150px;" class="text-end">Grand Total</th>
                        <th style="width: 140px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td class="font-monospace">{{ $sale->invoice_no }}</td>
                            <td>{{ $sale->customer?->name }}</td>
                            <td>{{ $sale->sale_date?->format('Y-m-d H:i') }}</td>
                            <td class="text-end">{{ number_format((float)$sale->grand_total, 2) }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('sales.show', $sale) }}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">No sales found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $sales->links() }}
        </div>
    </div>
@endsection

