<x-guest-layout>
    <div class="mb-4">
        <div class="h5 mb-1">Reset your password</div>
        <div class="text-secondary small">
            {{ __('Enter your email and we’ll send you a reset link.') }}
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="vstack gap-3">
        @csrf

        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autofocus
                autocomplete="username"
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">
                {{ __('Email Password Reset Link') }}
        </button>

        <div class="text-center small">
            <a class="link-secondary" href="{{ route('login') }}">{{ __('Back to login') }}</a>
        </div>
    </form>
</x-guest-layout>
