<section>
    <header>
        <h2 class="h6 mb-1">{{ __('Delete Account') }}</h2>
        <p class="text-secondary mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <div class="alert alert-warning mt-3 mb-0" role="alert">
        <div class="fw-semibold mb-1">{{ __('Danger zone') }}</div>
        <div class="small">
            {{ __('Deleting your account is permanent. Enter your password and confirm to proceed.') }}
        </div>
    </div>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-3 vstack gap-2">
        @csrf
        @method('delete')

        <div>
            <label for="delete_password" class="form-label">{{ __('Password') }}</label>
            <input
                id="delete_password"
                name="password"
                type="password"
                class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                autocomplete="current-password"
                placeholder="{{ __('Password') }}"
            />
            @if($errors->userDeletion->has('password'))
                <div class="invalid-feedback">{{ $errors->userDeletion->first('password') }}</div>
            @endif
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete your account?') }}')">
                {{ __('Delete Account') }}
            </button>
        </div>
    </form>
</section>
