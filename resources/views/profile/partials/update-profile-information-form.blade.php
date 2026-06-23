<section>
    <header style="margin-bottom: 24px;">
        <h2 style="font-size: 17px; font-weight: 700; color: var(--ds-text-primary); margin: 0;">{{ __('Profile Information') }}</h2>
        <p style="font-size: 13px; color: var(--ds-text-tertiary); margin: 4px 0 0;">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="saas-form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="saas-form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 8px;">
                    <p style="font-size: 13px; color: var(--ds-warning);">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" style="font-size: 13px; color: var(--ds-primary); text-decoration: underline; border: none; background: none; cursor: pointer; font-family: inherit;">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: 4px; font-size: 13px; color: var(--ds-success);">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" style="font-size: 13px; color: var(--ds-success);">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
