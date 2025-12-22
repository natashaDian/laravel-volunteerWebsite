<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth('company')->check() ? route('company.dashboard') : route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden space-x-6 sm:flex sm:ml-8">

                    {{-- USER NAV --}}
                    @if (!auth('company')->check())
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.*')">
                            Find Activities
                        </x-nav-link>

                        <x-nav-link :href="route('organizations.index')" :active="request()->routeIs('organizations.*')">
                            Find Organizations
                        </x-nav-link>

                        <x-nav-link :href="route('donations.index')" :active="request()->routeIs('donations.*')">
                            Donations
                        </x-nav-link>

                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            About Us
                        </x-nav-link>
                    @endif

                    {{-- COMPANY NAV --}}
                    @if (auth('company')->check())
                        <x-nav-link :href="route('company.dashboard')" :active="request()->routeIs('company.dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('company.activities.create')" :active="request()->routeIs('company.activities.create')">
                            Create Activity
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-500 bg-white dark:bg-gray-800">
                            <div>
                                {{ auth('company')->check()
                                    ? auth('company')->user()->name
                                    : (auth()->check() ? auth()->user()->name : 'Guest') }}
                            </div>

                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293L10 11.586l4.707-4.293 1.414 1.414-6.121 5.707a1 1 0 01-1.414 0L3.879 8.707l1.414-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- PROFILE --}}
                        @if (auth('company')->check())
                            <x-dropdown-link :href="route('company.profile.edit')">
                                Company Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('company.logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('company.logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-gray-400">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            {{-- USER --}}
            @if (!auth('company')->check())
                <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('activities.index')">Find Activities</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('organizations.index')">Find Organizations</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('donations.index')">Donations</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about')">About Us</x-responsive-nav-link>
            @endif

            {{-- COMPANY --}}
            @if (auth('company')->check())
                <x-responsive-nav-link :href="route('company.dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                {{-- 🔥 FIX DI SINI --}}
                <x-responsive-nav-link :href="route('company.activities.create')">
                    Create Activity
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>
