@extends('layouts.admin')

@section('page_title', 'Create Category')

@section('content')
    <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-link px-0">&larr; Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}" class="vstack gap-3">
                @csrf

                @include('admin.categories._form')

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

