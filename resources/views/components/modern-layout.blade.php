<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dr Roket - {{-- $title --}}</title>
    @vite('resources/js/modernApp.js')
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    {{-- TODO: Tukar logo(guna `modern-logo` attribute pastu pass location gambar dalam folder public) dan route --}}
    <x-modern-sidebar>
        <x-nav-header>Home</x-nav-header>

        <x-nav-item :href="route('modern')" icon="layout-dashboard">
            Dashboard
        </x-nav-item>

        <x-nav-item href="https://google.com">
            Hi
        </x-nav-item>
        <x-nav-header>Cat 2</x-nav-header>
        <x-nav-item href="https://youtube.com" icon="a-b-2">Youtube</x-nav-item>
    </x-modern-sidebar>
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <!--  Header Start -->
        <x-modern-header>
            <x-profile-in-header>
                <x-drop-down-menu>

                    <x-drop-down-item :href="route('modern')" icon="user">
                        My Profile
                    </x-drop-down-item>

                    <x-drop-down-item :href="route('modern')" icon="list-check">
                        My Task
                    </x-drop-down-item>

                    <x-drop-down-item-button :href="route('modern')">
                        Logout
                    </x-drop-down-item-button>

                </x-drop-down-menu>
            </x-profile-in-header>
        </x-modern-header>
        <!--  Header End -->

        <div class="container-fluid">
             {{-- $slot --}}
        </div>
    </div>
</div>
</body>

</html>
