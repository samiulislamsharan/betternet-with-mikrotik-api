<div class="w-64 min-h-screen bg-white hidden md:block">
    <nav class="mt-10">
        <div x-data="{ open: false }">

            <x-sidebar-item :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-sidebar-item>

            <x-sidebar-item :href="route('packages.index')" :active="request()->routeIs('packages.index')">{{ __('Packages') }}</x-sidebar-item>

            @if(auth()->user()->isAdmin())
                <x-sidebar-item :href="route('users.index')" :active="request()->routeIs('users.index')">{{ __('Users') }}</x-sidebar-item>
            @endif

            <x-sidebar-item :href="route('billing.index')" :active="request()->routeIs('billing.index')">{{ __('Billing') }}</x-sidebar-item>

            <x-sidebar-item :href="route('payment.index')" :active="request()->routeIs('payment.index')">{{ __('Payment') }}</x-sidebar-item>

            @if(auth()->user()->isAdmin())
                <x-sidebar-item :href="route('administration')" :active="request()->routeIs('administration')">{{ __('Administration') }}</x-sidebar-item>
            @endif

            <x-sidebar-item :href="route('ticket.index')" :active="request()->routeIs('ticket.index')">{{ __('Ticket') }}</x-sidebar-item>

            @if(auth()->user()->isAdmin())
                <x-sidebar-item :href="route('company.edit')" :active="request()->routeIs('company.edit')">{{ __('ISP') }}</x-sidebar-item>
            @endif

            @if(auth()->user()->isAdmin())
                <x-sidebar-item :href="route('settings.edit')" :active="request()->routeIs('settings.edit')">{{ __('Settings') }}</x-sidebar-item>
            @endif
        </div>
    </nav>
</div>
