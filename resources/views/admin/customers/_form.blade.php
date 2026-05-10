@php
    /** @var \App\Models\Customer|null $customer */
    $customer = $customer ?? null;
@endphp

<div class="row g-3">
    <div class="col-12 col-md-6">
        <label for="name" class="form-label">Name</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $customer?->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            required
        />
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="phone" class="form-label">Phone</label>
        <input
            id="phone"
            name="phone"
            type="text"
            value="{{ old('phone', $customer?->phone) }}"
            class="form-control @error('phone') is-invalid @enderror"
            required
        />
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-text">Must be unique.</div>
    </div>

    <div class="col-12">
        <label for="email" class="form-label">Email</label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', $customer?->email) }}"
            class="form-control @error('email') is-invalid @enderror"
        />
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <textarea
            id="address"
            name="address"
            rows="3"
            class="form-control @error('address') is-invalid @enderror"
        >{{ old('address', $customer?->address) }}</textarea>
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

