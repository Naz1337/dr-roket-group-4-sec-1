<li class="nav-item dropdown">

    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
       aria-expanded="false">
        <img src="{{ $profilePicture ? Storage::url($profilePicture) : '/assets/images/profile/user-1.jpg' }}" alt="" width="35" height="35" class="rounded-circle">
    </a>

    {{ $slot }}
</li>
