<div class="h-100 col  p-3 text-white bg-dark sidebar">
    <a href="#" class="align-items-center mb-3 p-3 mb-md-0 me-md-auto text-white text-decoration-none">Back</a>
    <hr>
    <div class="row nav nav-pills mb-auto">
        <div class="nav-item"><a href="{{ route('home') }}" class="nav-link text-white">Home</a></div>
        <div class="nav-item"><a href="{{ route('profile') }}" class="nav-link text-white">Profile</a></div>
        <div class="nav-dropdown">
            <a href="javascript:void(0);" class="nav-link nav-toggle text-white">
                Expert
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="{{ route('myexpert') }}" class="nav-link text-decoration-none text-white">My Expert</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-decoration-none text-white">Expert List</a>
                </li>
            </ul>
        </div>
        <div class="nav-dropdown">
            <a href="javascript:void(0);" class="nav-link text-white">
                Publication
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="{{ route('mypublication') }}" class="nav-link text-decoration-none text-white">My Publication</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-decoration-none text-white">Publication List</a>
                </li>
            </ul>
        </div>
        <li class="nav-item"><a href="#" class="nav-link text-white"></a></li>
    </div>
    <hr>
    <a href="{{ route('logout') }}" class=" p-3 text-white text-decoration-none">Log Out</a> 
</div>