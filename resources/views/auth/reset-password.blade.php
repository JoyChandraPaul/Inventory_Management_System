<x-guest-layout>
    <div class="mb-4">
        <div class="h5 mb-1">Choose a new password</div>
        <div class="text-secondary small">Make sure it’s strong and unique.</div>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="vstack gap-3">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
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
                    autocomplete="new-password"
                />
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn">Show</button>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
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
                {{ __('Reset Password') }}
        </button>

        <div class="text-center small">
            <a class="link-secondary" href="{{ route('login') }}">{{ __('Back to login') }}</a>
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
