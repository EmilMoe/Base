<a class="nav-link p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <avatar :size="40" username="Emil Moe"></avatar>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
    <a class="dropdown-item" href="{{ route('users.show', auth()->id()) }}">
        <i class="fas fa-user-cog"></i>
        Indstillinger
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt"></i>
        Logud
    </a>
</div>
