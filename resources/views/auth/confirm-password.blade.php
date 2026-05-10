<x-guest-layout>
    <div class="mb-4">
        <div class="h5 mb-1">Confirm your password</div>
        <div class="text-secondary small">
            {{ __('For your security, please confirm your password to continue.') }}
        </div>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="vstack gap-3">
        @csrf

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

        <button type="submit" class="btn btn-primary w-100 py-2">{{ __('Confirm') }}</button>
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
