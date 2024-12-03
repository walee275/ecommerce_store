<div
    x-data="{ mobileMenuOpen: false, searchOpen: false }"
    x-on:keydown.window.esc="mobileMenuOpen = false"
>
    {{-- Start mobile menu --}}
    <div
        x-cloak
        x-show="mobileMenuOpen"
        class="relative z-40 lg:hidden"
        role="dialog"
        aria-modal="true"
    >
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-25"
        ></div>

        <div class="fixed inset-0 z-40 flex">
            <div
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                x-on:click.away="mobileMenuOpen = false"
                class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl"
            >
                <div class="flex px-4 pt-5 pb-2">
                    <button
                        x-on:click="mobileMenuOpen = false"
                        type="button"
                        class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-slate-400"
                    >
                        <span class="sr-only">{{ __('Close menu') }}</span>
                        <x-heroicon-o-x-mark
                            class="h-6 w-6"
                            aria-hidden="true"
                        />
                    </button>
                </div>

                @if($this->headerMenu)
                    <div class="space-y-6 px-4 pt-10 pb-6">
                        <div class="grid grid-cols-1 items-start gap-y-6 gap-x-6">
                            @foreach($this->headerMenu->menuItems as $menuItem)
                                @if($menuItem->children->count())
                                    <div>
                                        <p class="font-medium text-slate-900">
                                            {{ $menuItem->name }}
                                        </p>
                                        <ul
                                            role="list"
                                            aria-labelledby="mobile-collection-heading"
                                            class="ml-3 mt-6 space-y-6"
                                        >
                                            @foreach($menuItem->children as $childBlock)
                                                <li x-data="{ open: false }">
                                                    <span
                                                        x-on:click="open = !open"
                                                        class="text-sm font-medium text-slate-900"
                                                    >
                                                        {{ $childBlock->name }}
                                                    </span>
                                                    <ul
                                                        x-show="open"
                                                        role="list"
                                                        aria-labelledby="{{ $childBlock->name }}-heading"
                                                        class="ml-3 mt-6 space-y-6 text-sm sm:mt-4 sm:space-y-4"
                                                    >
                                                        @foreach($childBlock->children as $child)
                                                            <li class="flex">
                                                                <a
                                                                    href="{{ $child->url }}"
                                                                    class="hover:text-slate-800"
                                                                >{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div class="flow-root">
                                        <a
                                            href="{{ $menuItem->url }}"
                                            class="-m-2 block p-2 font-medium text-slate-900"
                                        >
                                            {{ $menuItem->name }}
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-6 border-t border-slate-200 py-6 px-4">
                        @guest()
                            <div class="flow-root">
                                <a
                                    href="{{ route('login') }}"
                                    class="-m-2 block p-2 font-medium text-slate-900"
                                >
                                    {{ __('Sign in') }}
                                </a>
                            </div>
                            <div class="flow-root">
                                <a
                                    href="{{ route('register') }}"
                                    class="-m-2 block p-2 font-medium text-slate-900"
                                >
                                    {{ __('Create account') }}
                                </a>
                            </div>
                        @else
                            <div class="flow-root">
                                <a
                                    href="{{ route('customer.profile') }}"
                                    class="-m-2 block p-2 font-medium text-slate-900"
                                >
                                    {{ __('Profile') }}
                                </a>
                            </div>
                            <div class="flow-root">
                                <a
                                    href="{{ route('customer.orders.list') }}"
                                    class="-m-2 block p-2 font-medium text-slate-900"
                                >
                                    {{ __('Orders') }}
                                </a>
                            </div>
                            <div class="flow-root">
                                <form
                                    action="{{ route('logout') }}"
                                    method="POST"
                                >
                                    @csrf
                                    <a
                                        href="{{ route('logout') }}"
                                        class="-m-2 block p-2 font-medium text-slate-900"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                    >
                                        {{ __('Logout') }}
                                    </a>
                                </form>
                            </div>
                        @endguest
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- End mobile menu --}}

    <header class="relative bg-white">
        @if($layoutSettings->header_top_bar_enabled)
            <div class="bg-sky-700">
                <div class="mx-auto flex h-10 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                    <p class="text-sm font-medium text-white">
                        {!! $layoutSettings->header_top_bar_message !!}
                    </p>
                    <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        @if($this->topBarMenu)
                            @foreach($this->topBarMenu->menuItems as $menuItem)
                                <a
                                    href="{{ $menuItem->url }}"
                                    class="text-sm font-medium text-white hover:text-gray-100"
                                >
                                    {{ $menuItem->name }}
                                </a>
                                @if(!$loop->last)
                                    <span
                                        class="h-6 w-px bg-sky-600/50"
                                        aria-hidden="true"
                                    ></span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="border-b border-slate-200">
            <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    {{-- Mobile menu toggle, controls the 'mobileMenuOpen' state. --}}
                    <div class="flex flex-1 lg:hidden">
                        <button
                            x-on:click="mobileMenuOpen = true"
                            type="button"
                            class="bg-white -ml-2 p-2 text-slate-400"
                        >
                            <span class="sr-only">{{ __('Open menu') }}</span>
                            <x-heroicon-m-bars-3 class="h-6 w-6" />
                        </button>
                    </div>

                    {{-- Logo --}}
                    <a href="/">
                        <span class="sr-only">{{ config('app.name') }}</span>
                        <img
                            src="{{ $brandSettings->logo_path ? Storage::url($brandSettings->logo_path) : asset('img/logo.png') }}"
                            alt="{{ config('app.name') }}"
                            class="h-8 w-auto"
                            height="32"
                            width="32"
                        >
                    </a>

                    {{-- Flyout menus --}}
                    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="flex h-full justify-center space-x-8">
                            @if($this->headerMenu)
                                @foreach($this->headerMenu->menuItems as $menuItem)
                                    @if($menuItem->children->count())
                                        <div
                                            x-data="{ open: false }"
                                            x-on:keydown.escape="open = false"
                                            class="flex"
                                        >
                                            <div class="relative flex">
                                                <button
                                                    x-on:click="open = !open"
                                                    type="button"
                                                    class="relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                    x-bind:class="{ 'border-sky-600 text-sky-600': open, 'border-transparent text-slate-700 hover:text-slate-800': !open }"
                                                    x-bind:aria-expanded="open.toString()"
                                                >
                                                    <span>{{ $menuItem->name }}</span>
                                                </button>
                                            </div>
                                            <div
                                                x-cloak
                                                x-show="open"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-5"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 translate-y-5"
                                                x-on:click.away="open = false"
                                                class="absolute inset-x-0 top-full text-sm text-slate-500 z-10"
                                            >
                                                <div
                                                    class="absolute inset-0 top-1/2 bg-white shadow"
                                                    aria-hidden="true"
                                                ></div>
                                                <div class="relative bg-white">
                                                    <div class="mx-auto max-w-7xl px-8">
                                                        <div class="grid grid-cols-5 gap-y-10 gap-x-8 py-16 text-sm">
                                                            @foreach($menuItem->children as $childBlock)
                                                                <div>
                                                                    <p
                                                                        id="{{ $childBlock->name }}-heading"
                                                                        class="font-medium text-slate-900"
                                                                    >
                                                                        {{ $childBlock->name }}
                                                                    </p>
                                                                    <ul
                                                                        role="list"
                                                                        aria-labelledby="{{ $childBlock->name }}-heading"
                                                                        class="mt-6 space-y-6 sm:mt-4 sm:space-y-4"
                                                                    >
                                                                        @foreach($childBlock->children as $childItem)
                                                                            <li class="flex">
                                                                                <a
                                                                                    href="{{ $childItem->url }}"
                                                                                    class="hover:text-slate-800"
                                                                                >
                                                                                    {{ $childItem->name }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a
                                            href="{{ $menuItem->url }}"
                                            class="flex items-center text-sm font-medium text-slate-700 hover:text-slate-800"
                                        >
                                            {{ $menuItem->name }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                            @if(!$is_local && !$is_staging && !$generalSettings->license_active)
                                <livewire:components.faded />
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-1 items-center justify-end lg:ml-auto">
                        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                            @guest()
                                <a
                                    href="{{ route('login') }}"
                                    class="text-sm font-medium text-slate-700 hover:text-slate-800"
                                >
                                    {{ __('Sign in') }}
                                </a>
                                <span
                                    class="h-6 w-px bg-slate-200"
                                    aria-hidden="true"
                                ></span>
                                <a
                                    href="{{ route('register') }}"
                                    class="text-sm font-medium text-slate-700 hover:text-slate-800"
                                >
                                    {{ __('Create account') }}
                                </a>
                            @else
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <button
                                            type="button"
                                            class="flex items-center text-sm font-medium text-slate-700 hover:text-slate-800"
                                        >
                                            <span>{{ auth()->user()->name }}</span>
                                            <x-heroicon-m-chevron-down class="ml-1.5 -mr-1 h-5 w-5" />
                                        </button>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <x-dropdown-link href="{{ route('customer.profile') }}">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('customer.orders.list') }}">
                                            {{ __('Orders') }}
                                        </x-dropdown-link>
                                        <hr class="border-slate-200" />
                                        <form
                                            method="POST"
                                            action="{{ route('logout') }}"
                                        >
                                            @csrf
                                            <x-dropdown-link
                                                :href="route('logout')"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                            >
                                                {{ __('Sign out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot:content>
                                </x-dropdown>
                            @endguest
                        </div>

                        {{-- Spotlight --}}
                        <div class="flex lg:ml-6">
                            <button
                                x-on:click="$dispatch('open-search')"
                                class="p-2 text-slate-400 hover:text-slate-500"
                            >
                                <span class="sr-only">{{ __('Search') }}</span>
                                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
                            </button>
                        </div>

                        <!-- Cart -->
                        <div class="ml-4 flow-root lg:ml-6">
                            <a
                                href="{{ route('guest.cart') }}"
                                class="group -m-2 flex items-center p-2"
                            >
                                <x-heroicon-o-shopping-cart class="h-6 w-6 flex-shrink-0 text-slate-400 group-hover:text-slate-500" />
                                <span class="ml-2 text-sm font-medium text-slate-700 group-hover:text-slate-800">{{ $itemsCount ?? 0 }}</span>
                                <span class="sr-only">{{ __('items in cart, view cart') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</div>
