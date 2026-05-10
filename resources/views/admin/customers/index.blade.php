@extends('layouts.admin')

@section('page_title', 'Customers')

@section('content')
    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
        <form method="GET" class="d-flex gap-2" action="{{ route('customers.index') }}">
            <input
                type="text"
                name="q"
                value="{{ $q }}"
                class="form-control"
                placeholder="Search name or phone..."
            />
            <button class="btn btn-outline-secondary" type="submit">Search</button>
            @if($q !== '')
                <a class="btn btn-link" href="{{ route('customers.index') }}">Clear</a>
            @endif
        </form>

        <a class="btn btn-primary" href="{{ route('customers.create') }}">Add Customer</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th style="width: 180px;">Phone</th>
                        <th style="width: 260px;">Email</th>
                        <th>Address</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td class="fw-semibold">{{ $customer->name }}</td>
                            <td class="font-monospace">{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td class="text-truncate" style="max-width: 340px;">{{ $customer->address }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('customers.edit', $customer) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('customers.destroy', $customer) }}"
                                    onsubmit="return confirm('Delete this customer?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $customers->links() }}
        </div>
    </div>
@endsection

