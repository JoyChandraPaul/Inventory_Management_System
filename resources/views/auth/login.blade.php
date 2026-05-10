<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-info mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-4">
        <div class="h5 mb-1">Welcome back</div>
        <div class="text-secondary small">Enter your email and password to continue.</div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="vstack gap-3">
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

        <div>
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required
                    autocomplete="current-password"
                />
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn">Show</button>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember" @checked(old('remember'))>
                <label class="form-check-label" for="remember_me">
                    {{ __('Remember me') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="link-secondary" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
                {{ __('Log in') }}
        </button>

        <div class="text-center small text-secondary mt-2">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </form>

    <script>
        (() => {
            const btn = document.getElementById('togglePasswordBtn');
            const input = document.getElementById('password');
            if (!btn || !input) return;
            btn.addEventListener('click', () => {
                const next = input.type === 'password' ? 'text' : 'password';
                input.type = next;
                btn.textContent = next === 'password' ? 'Show' : 'Hide';
            });
        })();
    </script>
</x-guest-layout>
