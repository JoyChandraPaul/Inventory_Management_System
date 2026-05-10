@extends('layouts.admin')

@section('page_title', 'Categories')

@section('content')
    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
        <form method="GET" class="d-flex gap-2" action="{{ route('categories.index') }}">
            <input
                type="text"
                name="q"
                value="{{ $q }}"
                class="form-control"
                placeholder="Search categories..."
            />
            <button class="btn btn-outline-secondary" type="submit">Search</button>
            @if($q !== '')
                <a class="btn btn-link" href="{{ route('categories.index') }}">Clear</a>
            @endif
        </form>

        <a class="btn btn-primary" href="{{ route('categories.create') }}">Add Category</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 90px;">Order</th>
                        <th>Name</th>
                        <th style="width: 140px;">Status</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->sort_order }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td>
                                @if($category->status)
                                    <span class="badge text-bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('categories.edit', $category) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category) }}"
                                    onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $categories->links() }}
        </div>
    </div>
@endsection

