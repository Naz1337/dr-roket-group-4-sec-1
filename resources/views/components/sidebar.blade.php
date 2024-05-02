<div class="h-100 col  p-3 text-white bg-dark sidebar">
    <a href="#" class="back row align-items-center mb-3 p-3 mb-md-0 me-md-auto text-white text-decoration-none">Back</a>
    <hr>
    
    <div class="row mb-3 p-3 mb-md-0 me-md-auto nav-item"><a href="{{ route('home') }}" class="nav-link text-white">Home</a></div>
    <div class="row mb-3 p-3 mb-md-0 me-md-auto nav-item"><a href="{{ route('profile') }}" class="nav-link text-white">Profile</a></div>
    <div class="row mb-3 p-3 mb-md-0 me-md-auto nav-dropdown">
        <a href="javascript:void(0);" class="mb-3 p-3 mb-md-0 me-md-auto nav-link nav-toggle text-white">
            Expert
        </a>
        <ul class="nav-sub">
            <li class="mb-3 p-3 mb-md-0 me-md-auto nav-item">
                <a href="{{ route('myexpert') }}" class="nav-link text-decoration-none text-white">My Expert</a>
            </li>
            <li class="mb-3 p-3 mb-md-0 me-md-auto nav-item">
                <a href="{{ route('listexpert') }}" class="nav-link text-decoration-none text-white">Expert List</a>
            </li>
        </ul>
    </div>
    <div class="row mb-3 p-3 mb-md-0 me-md-auto nav-dropdown">
        <a href="javascript:void(0);" class="mb-3 p-3 mb-md-0 me-md-auto nav-link text-white">
            Publication
        </a>
        <ul class="nav-sub">
            <li class="mb-3 p-3 mb-md-0 me-md-auto nav-item">
                <a href="{{ route('mypublication') }}" class="nav-link text-decoration-none text-white">My Publication</a>
            </li>
            <li class="mb-3 p-3 mb-md-0 me-md-auto nav-item">
                <a href="#" class="nav-link text-decoration-none text-white">Publication List</a>
            </li>
        </ul>
    </div>
    <div class="row mb-3 p-3 mb-md-0 me-md-auto nav-item"><a href="#" class="nav-link text-decoration-none text-white">Focus</a></div>
    <div class="row mb-3 p-3 mb-md-0 me-md-auto nav-item"><a href="#" class="nav-link text-decoration-none text-white">Draft</a></div>
    <hr>
    <a href="{{ route('logout') }}" class="logout row p-3 text-white text-decoration-none">Log Out</a> 
</div>