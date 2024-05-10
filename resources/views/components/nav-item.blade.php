<li class="sidebar-item">
    <a class="sidebar-link" href="{{ $href }}" target="{{ $target }}" aria-expanded="false">
        <span>
          <i class="ti {{ "ti-" . $icon }}"></i>
        </span>
        <span class="hide-menu">{{ $slot }}</span>
    </a>
</li>
