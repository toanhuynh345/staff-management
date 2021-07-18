<div class="main-navbar sticky-top bg-white">
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <div class="main-navbar__search w-100 d-none d-md-flex d-lg-flex"></div>
        <ul class="navbar-nav border-left flex-row">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-4 mt-2" data-toggle="dropdown" href="javascript:"
                   role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block">{{auth('admin')->user()->name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-small">
                    <a class="dropdown-item" href="{{route('admin.users.profile')}}">
                        <i class="material-icons">&#xE7FD;</i> {{__('text.profile')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('logout')}}">
                        <i class="material-icons text-danger">&#xE879;</i> {{__('text.logout')}}
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>
