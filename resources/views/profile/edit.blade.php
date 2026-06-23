<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, var(--ds-primary), #8b5cf6); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; font-weight: 600;">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div>
                <h2 style="font-size: 18px; font-weight: 700; color: var(--ds-text-primary); margin: 0;">{{ __('Profile') }}</h2>
                <p style="font-size: 13px; color: var(--ds-text-tertiary); margin: 2px 0 0;">Manage your account settings</p>
            </div>
        </div>
    </x-slot>

    <div style="max-width: 800px; margin: 0 auto;">
        <div class="saas-card mb-4">
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="saas-card mb-4">
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="saas-card">
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
