<x-guest-layout>
    <div class="mb-4">
        <div class="h5 mb-1">Verify your email</div>
        <div class="text-secondary small">
            {{ __('We sent a verification link to your email address. Please click it to activate your account.') }}
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-3" role="alert">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="vstack gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn btn-primary w-100 py-2">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-outline-secondary w-100 py-2">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
