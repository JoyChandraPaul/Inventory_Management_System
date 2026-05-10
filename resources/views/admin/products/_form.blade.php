@php
    /** @var \App\Models\Product|null $product */
    $product = $product ?? null;
@endphp

<div class="row g-3">
    <div class="col-12">
        <label for="name" class="form-label">Product Name</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $product?->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            required
        />
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="category_id" class="form-label">Category</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="" disabled @selected(old('category_id', $product?->category_id) === null)>Select category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected((int)old('category_id', $product?->category_id) === $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="sku" class="form-label">SKU</label>
        <input
            id="sku"
            name="sku"
            type="text"
            value="{{ old('sku', $product?->sku) }}"
            class="form-control @error('sku') is-invalid @enderror"
            required
        />
        @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-text">Must be unique. Allowed: letters, numbers, dashes, underscores.</div>
    </div>

    <div class="col-12 col-md-4">
        <label for="price" class="form-label">Price</label>
        <input
            id="price"
            name="price"
            type="number"
            step="0.01"
            min="0"
            value="{{ old('price', $product?->price) }}"
            class="form-control @error('price') is-invalid @enderror"
            required
        />
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="stock_qty" class="form-label">Stock Quantity</label>
        <input
            id="stock_qty"
            name="stock_qty"
            type="number"
            min="0"
            value="{{ old('stock_qty', $product?->stock_qty ?? 0) }}"
            class="form-control @error('stock_qty') is-invalid @enderror"
            required
        />
        @error('stock_qty') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
            @php($current = old('status', $product?->status ?? 1))
            <option value="1" @selected((string)$current === '1')>Active</option>
            <option value="0" @selected((string)$current === '0')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="image" class="form-label">Product Image</label>
        <input id="image" name="image" class="form-control @error('image') is-invalid @enderror" type="file" accept="image/*" />
        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if($product?->image_path)
            <div class="form-text mt-2">
                Current:
                <a href="{{ asset('storage/'.$product->image_path) }}" target="_blank" rel="noreferrer">View image</a>
            </div>
        @endif
    </div>
</div>

