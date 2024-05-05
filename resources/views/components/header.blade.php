<div class="header">
    <a href="/"><img class="img-fluid" style="width:200px;" src="{{ @asset('logo.png') }}" alt="Logo system"></a>
    <div class="header-action">
        {{-- TODO: guna @@if untuk tengok dah login ke belum --}}
        @if (strpos(url()->current(), "login") !== false)
        <a href="{{ route('register') }}">
            <button class="btn btn-primary">Register</button>
        </a>
        @elseif (strpos(url()->current(), "register") !== false)
        <a href="{{ route('login') }}">
            <button class="btn btn-primary">Login</button>
        </a>
        @else
        {{-- Letak component user head punya bende ikut figma --}}
        <div>Logged in as who tho</div>
        @endif
    </div>
</div>