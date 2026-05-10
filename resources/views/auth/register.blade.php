<x-guest-layout>
    <div class="mb-4">
        <div class="h5 mb-1">Create your account</div>
        <div class="text-secondary small">It only takes a minute.</div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="vstack gap-3">
        @csrf

        <div>
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                required
                autofocus
                autocomplete="name"
            />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required
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
                    autocomplete="new-password"
                />
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn">Show</button>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-text">Use at least 8 characters.</div>
        </div>

        <div>
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    required
                    autocomplete="new-password"
                />
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmBtn">Show</button>
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            {{ __('Register') }}
        </button>

        <div class="text-center small text-secondary">
            <a class="link-secondary" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>

    <script>
        (() => {
            const btn = document.getElementById('togglePasswordBtn');
            const input = document.getElementById('password');
            if (btn && input) {
                btn.addEventListener('click', () => {
                    const next = input.type === 'password' ? 'text' : 'password';
                    input.type = next;
                    btn.textContent = next === 'password' ? 'Show' : 'Hide';
                });
            }

            const btn2 = document.getElementById('togglePasswordConfirmBtn');
            const input2 = document.getElementById('password_confirmation');
            if (btn2 && input2) {
                btn2.addEventListener('click', () => {
                    const next = input2.type === 'password' ? 'text' : 'password';
                    input2.type = next;
                    btn2.textContent = next === 'password' ? 'Show' : 'Hide';
                });
            }
        })();
    </script>
</x-guest-layout>
