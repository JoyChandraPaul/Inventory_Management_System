@extends('layouts.admin')

@section('page_title', 'Edit Customer')

@section('content')
    <div class="mb-3 d-flex align-items-center justify-content-between">
        <a href="{{ route('customers.index') }}" class="btn btn-link px-0">&larr; Back</a>
        <form method="POST" action="{{ route('customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('customers.update', $customer) }}" class="vstack gap-3">
                @csrf
                @method('PUT')

                @include('admin.customers._form', ['customer' => $customer])

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

