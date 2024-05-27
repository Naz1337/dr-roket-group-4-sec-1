@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Config; @endphp
    <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dr Roket - {{ $title }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ @asset('logo.png') }}"/>
    @vite('resources/js/modernApp.js')
    @section("scripts")
        @parent
    @show
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    @if(Auth::check() && !request()->routeIs('register'))
        <!-- Sidebar Start -->
        <x-modern-sidebar>
            @php
                echo match (Auth::user()->user_type) {
                    Config::get('constants.user.platinum') => ('Platinum'),
                    Config::get('constants.user.crmp') => ('CRMP'),
                    Config::get('constants.user.staff') => ('Staff'),
                    Config::get('constants.user.mentor') => ('Mentor'),
                };
            @endphp
            <x-nav-header>User</x-nav-header>
            <x-nav-item href="{{ route('register-platinum') }}" icon="user-plus">Registration</x-nav-item>
            <x-nav-item href="{{ route('manage-platinum') }}" icon="user-cog">Manage User Profile</x-nav-item>

            @if(Auth::user()->user_type != Config::get('constants.user.staff'))
                <x-nav-header>Expert Domain</x-nav-header>
                <x-nav-item href="#" icon="certificate">Manage Expert Domain</x-nav-item>

                <x-nav-header>Publication</x-nav-header>
                <x-nav-item href="#" icon="script">Manage Publication Data</x-nav-item>
            @endif

            <x-nav-header>Monitoring</x-nav-header>
            @if(Auth::user()->user_type != Config::get('constants.user.staff'))
                <x-nav-item href="#" icon="trending-up">Platinum Progress</x-nav-item>
            @endif
            <x-nav-item href="#" icon="user-plus">Assign CRMP</x-nav-item>

            <x-nav-header>Progress Monitoring</x-nav-header>
            <x-nav-item :href="route('')"
        </x-modern-sidebar>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <!--  Header Start -->
            <x-modern-header>
                <li class="navbar-item pt-3">
                    <p class="navbar-text fw-semibold fs-4">Hello, {{ Auth::user()->username }}</p>
                </li>
                <x-profile-in-header
                    profile-picture="{{ base64_encode(Auth::user()->user_type != 0 ? Auth::user()->getUserProfile()->user_photo : Auth::user()->getPlatinum()->plat_photo) }}">
                    <x-drop-down-menu>
                        {{-- TODO: link logout ngan yang lain dalam dropdown profile ni kepada benda yang patut --}}
                        <x-drop-down-item :href="route('modern')" icon="user">
                            My Profile
                        </x-drop-down-item>

                        <x-drop-down-item :href="route('modern')" icon="list-check">
                            My Task
                        </x-drop-down-item>

                        <x-drop-down-item-button :href="route('logout')">
                            Logout
                        </x-drop-down-item-button>

                    </x-drop-down-menu>
                </x-profile-in-header>
            </x-modern-header>
            <!--  Header End -->

            <div class="container-fluid px-0 mx-auto">
                {{ $slot }}
            </div>
        </div>
    @else
        {{ $slot }}
    @endif
</div>
</body>

</html>
