@auth
<nav x-data="{ open: false }" style="background: var(--ds-surface); border-bottom: 1px solid var(--ds-border); position: sticky; top: 0; z-index: 1030;">
    <div style="max-width: var(--ds-content-max-width); margin: 0 auto; padding: 0 24px;">
        <div style="display: flex; justify-content: space-between; height: 64px; align-items: center;">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
                    <div style="width: 34px; height: 34px; background: linear-gradient(135deg, var(--ds-primary), #8b5cf6); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; font-weight: 700;">M</div>
                    <span style="font-size: 16px; font-weight: 700; color: var(--ds-text-primary);">{{ config('app.name', 'ERP') }}</span>
                </a>
            </div>

            <div class="hidden sm:flex items-center gap-1">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" style="padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 500;">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </div>

            <div class="hidden sm:flex items-center gap-2">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button style="display: flex; align-items: center; gap: 8px; padding: 4px 8px 4px 4px; border-radius: 8px; border: none; background: transparent; cursor: pointer; font-family: inherit;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, var(--ds-primary), #8b5cf6); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 600;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="text-left" style="line-height: 1.2;">
                                <div style="font-size: 13px; font-weight: 600; color: var(--ds-text-primary);">{{ Auth::user()->name }}</div>
                                <div style="font-size: 11px; color: var(--ds-text-tertiary);">{{ Auth::user()->email }}</div>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" style="padding: 8px 12px; display: flex; align-items: center; gap: 8px; border-radius: 6px;">
                            <i class="bi bi-person" style="width: 16px; color: var(--ds-text-tertiary);"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <div style="border-top: 1px solid var(--ds-border); margin: 4px 6px;"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    style="padding: 8px 12px; display: flex; align-items: center; gap: 8px; border-radius: 6px; color: var(--ds-danger);">
                                <i class="bi bi-box-arrow-right" style="width: 16px;"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" style="width: 36px; height: 36px; border: none; background: transparent; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--ds-text-secondary);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="border-top: 1px solid var(--ds-border); padding: 8px 16px;">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1" style="border-top: 1px solid var(--ds-border);">
            <div class="px-4">
                <div style="font-weight: 600; color: var(--ds-text-primary);">{{ Auth::user()->name }}</div>
                <div style="font-size: 13px; color: var(--ds-text-tertiary);">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
@endauth
