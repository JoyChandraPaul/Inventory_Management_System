@extends('layouts.admin')

@section('page_title', 'Edit Product')

@section('content')
    <div class="mb-3 d-flex align-items-center justify-content-between">
        <a href="{{ route('products.index') }}" class="btn btn-link px-0">&larr; Back</a>
        <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="vstack gap-3">
                @csrf
                @method('PUT')

                @include('admin.products._form', ['product' => $product, 'categories' => $categories])

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

