<div class="h-auto d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidebar">
    <a href="#" class="d-flex align-items-center mb-3 p-3 mb-md-0 me-md-auto text-white text-decoration-none">Back</a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-white">Home</a></li>
        <li class="nav-item"><a href="{{ route('profile') }}" class="nav-link text-white">Profile</a></li>
        <li class="nav-item"><a href="{{ route('myexpert') }}" class="nav-link text-white">Expert</a></li>
        <li class="nav-item"><a href="{{ route('mypublication') }}" class="nav-link text-white">Publication</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"></a></li>
    </ul>
    <hr>
    <a href="{{ route('logout') }}" class=" p-3 text-white text-decoration-none">Log Out</a> 
</div>