<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('aboleon/framework/css/fontawesome/css/all.min.css') }}">
    <link href="{{ asset('aboleon/framework/css/gentellela.css') }}" rel="stylesheet">
{!! csscrush_inline(public_path('aboleon/framework/css/panel.css')) !!}
@livewireStyles
@stack('css')
<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="theme-aboleon nav-md">
<x-jet-banner/>
<div class="container body">

    <div class="col-md-3 left_col bg-white border-b border-gray-100">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <nav>
                    <!-- Primary Navigation Menu -->
                    <div>
                        <!-- Logo -->
                        <div class="items-center px-3 pt-2 pb-4 app-mark">
                            <a href="{{ route('aboleon.framework.dashboard') }}">
                                <x-jet-application-mark/>
                            </a>
                        </div>

                        <div id="sidebar-menu" class="main_menu_side bg-white main_menu">
                            <ul class="nav side-menu">
                                <x-aboleon.framework-nav-link icon="fas fa-chart-pie" route="aboleon.framework.dashboard" :title="__('aboleon.framework::ui.dashboard')"/>
                                @includeIf('navigation-vertical')
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="right_col" role="main">
        <div class="bg-white shadow d-flex justify-content-between align-items-center px-3 py-2">
            <a id="menu_toggle"><i class="fas fa-bars"></i></a>
            <x-aboleon.framework-header :title="$title"/>
            <nav class="nav navbar-nav">
                <ul class="m-0 p-0">
                    <li>
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('aboleon.framework::ui.account.manage') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('aboleon.framework::ui.account.label') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('aboleon.framework::ui.account.logout') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </li>
                </ul>
            </nav>
        </div>

        {{ $slot }}

    </div>
</div>
@stack('modals')

@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('aboleon/framework/js/gentellela.js') }}"></script>
<script src="{!! asset('aboleon/framework/js/common.js?'.time()) !!}"></script>
@stack('callbacks')
@stack('js')

</body>
</html>
