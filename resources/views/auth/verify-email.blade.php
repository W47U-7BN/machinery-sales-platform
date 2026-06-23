<x-guest-layout>
    <div style="text-align: center; margin-bottom: 24px;">
        <div style="width: 56px; height: 56px; background: var(--ds-warning-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px;">📧</div>
        <h2 style="font-size: 22px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 4px;">Verify Email</h2>
        <p style="font-size: 14px; color: var(--ds-text-tertiary); margin: 0;">Please verify your email address</p>
    </div>

    <div class="mb-4" style="font-size: 13px; color: var(--ds-text-secondary);">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="saas-alert saas-alert-success mb-4" role="alert">
            <span class="alert-icon">✓</span>
            <div class="alert-content">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</div>
        </div>
    @endif

    <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="saas-btn saas-btn-primary">
                <span class="btn-text">{{ __('Resend Verification Email') }}</span>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="saas-btn saas-btn-ghost">
                <i class="bi bi-box-arrow-right"></i>
                <span class="btn-text">{{ __('Log Out') }}</span>
            </button>
        </form>
    </div>
</x-guest-layout>
