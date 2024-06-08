@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Config;
    use App\Enums\Roles;
@endphp
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
            <div class="fw-bold logged-in-as" >
                Logged in as: {{ ucwords(Roles::getEnumKey(auth()->user()->user_type)) }}
            </div>
            <x-nav-header>User</x-nav-header>
            <x-nav-item href="{{ route('register-platinum') }}" icon="user-plus">Registration</x-nav-item>
            <x-nav-item href="{{ route('manage-user-profile') }}" icon="user-cog">Manage User Profile</x-nav-item>

            @if(Auth::user()->user_type != Config::get('constants.user.staff'))
                <x-nav-header>Expert Domain</x-nav-header>
                <x-nav-item href="{{ route('my-expert') }}" icon="certificate">My Expert Domain</x-nav-item>
                <x-nav-item href="{{ route('list-expert') }}" icon="certificate">Expert Domain List</x-nav-item>
            @endif
            @if (auth()->user()->user_type === Roles::PLATINUM )
            <x-nav-header>Publication</x-nav-header>
                <x-nav-item href="{{ route('mypublication') }}" icon="script">Manage Publication</x-nav-item>
                <x-nav-item href="{{ route('searchpublication') }}" icon="search">Search Other Publication</x-nav-item>
            @endif  
            @if (auth()->user()->user_type === Roles::MENTOR )
                <x-nav-header>Publication</x-nav-header>
                <x-nav-item href="{{ route('searchpublication') }}" icon="search">Search Other Publication</x-nav-item>
                <x-nav-item href="{{ route('publicationreport') }}" icon="report">Publication Report</x-nav-item>
            @endif

            <x-nav-header>Progress Monitoring</x-nav-header>

            @if(auth()->user()->platinum !== null)

                @if (auth()->user()->platinum->crmp !== null)
                    <x-nav-item :href="route('view-profile-id', ['id' => auth()->user()->platinum->crmp->id])" icon="user">My CRMP</x-nav-item>
                @endif
                <x-nav-item :href="route('draft.index')" icon="edit">My Draft Progression</x-nav-item>
                <x-nav-item :href="route('weekly-focus.create')" icon="calendar">Weekly Focus</x-nav-item>

            @endif

            @if (auth()->user()->user_type === Roles::MENTOR ||
                auth()->user()->user_type === Roles::PLATINUM && auth()->user()->platinum->is_crmp)
                <x-nav-item :href="route('crmp.my_platinums')" icon="chart-line">Check Platinum Progress</x-nav-item>
            @endif

            @if (auth()->user()->user_type === Roles::STAFF)
                <x-nav-item :href="route('crmp.index')" icon="user">Assign CRMP</x-nav-item>
            @endif
        </x-modern-sidebar>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <!--  Header Start -->
            <x-modern-header>
                <li class="navbar-item pt-3">
                    <p class="navbar-text fw-semibold fs-4">Hello, {{ !in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP')) ? Auth::user()->userProfile->profile_name : Auth::user()->getPlatinum()->plat_name }}</p>
                </li>
                <x-profile-in-header
                    profile-picture="{{ !in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP')) ? Auth::user()->userProfile->user_photo : Auth::user()->getPlatinum()->plat_photo }}">
                    <x-drop-down-menu>
                        <x-drop-down-item :href="route('view-profile-id', Auth::user()->id)" icon="user">
                            My Profile
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
