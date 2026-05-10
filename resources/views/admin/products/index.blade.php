@extends('layouts.admin')

@section('page_title', 'Products')

@section('content')
    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
        <form method="GET" class="d-flex flex-wrap gap-2" action="{{ route('products.index') }}">
            <input
                type="text"
                name="q"
                value="{{ $q }}"
                class="form-control"
                placeholder="Search name or SKU..."
            />
            <select class="form-select" name="category_id">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected((int)$categoryId === $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary" type="submit">Filter</button>
            @if($q !== '' || $categoryId)
                <a class="btn btn-link" href="{{ route('products.index') }}">Clear</a>
            @endif
        </form>

        <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 70px;">Image</th>
                        <th>Name</th>
                        <th style="width: 160px;">Category</th>
                        <th style="width: 140px;">SKU</th>
                        <th style="width: 120px;" class="text-end">Price</th>
                        <th style="width: 140px;" class="text-end">Stock</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image_path)
                                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="" width="48" height="48" class="rounded border object-fit-cover">
                                @else
                                    <div class="bg-body-secondary border rounded d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                        <span class="text-secondary small">N/A</span>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ $product->category?->name }}</td>
                            <td><span class="font-monospace">{{ $product->sku }}</span></td>
                            <td class="text-end">{{ number_format((float)$product->price, 2) }}</td>
                            <td class="text-end">{{ number_format($product->stock_qty) }}</td>
                            <td>
                                @if($product->status)
                                    <span class="badge text-bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $product) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('products.destroy', $product) }}"
                                    onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary py-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $products->links() }}
        </div>
    </div>
@endsection

