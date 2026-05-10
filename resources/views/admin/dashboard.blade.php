@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <div class="row g-3">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Total Products</div>
                    <div class="fs-4 fw-semibold">{{ number_format($totalProducts) }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Total Customers</div>
                    <div class="fs-4 fw-semibold">{{ number_format($totalCustomers) }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Total Sales</div>
                    <div class="fs-4 fw-semibold">{{ number_format($totalSales) }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Total Revenue</div>
                    <div class="fs-4 fw-semibold">{{ number_format($totalRevenue, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-secondary small">Low Stock Products</div>
                        <div class="fs-4 fw-semibold">{{ number_format($lowStockCount) }}</div>
                        <div class="text-secondary small">Threshold: {{ $lowStockThreshold }}</div>
                    </div>
                    <div>
                        <span class="badge text-bg-warning">Stock Watch</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

