@php
    /** @var \App\Models\Category|null $category */
    $category = $category ?? null;
@endphp

<div class="row g-3">
    <div class="col-12">
        <label for="name" class="form-label">Name</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $category?->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            required
        />
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
            @php($current = old('status', $category?->status ?? 1))
            <option value="1" @selected((string)$current === '1')>Active</option>
            <option value="0" @selected((string)$current === '0')>Inactive</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="sort_order" class="form-label">Order</label>
        <input
            id="sort_order"
            name="sort_order"
            type="number"
            min="0"
            value="{{ old('sort_order', $category?->sort_order ?? 0) }}"
            class="form-control @error('sort_order') is-invalid @enderror"
            required
        />
        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

