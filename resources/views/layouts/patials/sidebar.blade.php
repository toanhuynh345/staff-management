<div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="{{route('admin.home.index')}}" style="line-height: 25px;">
            <div class="d-table m-auto">
                <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                     src="{{asset_url('images/logo.png')}}" alt="Shards Dashboard">
                <span class="d-none d-md-inline ml-1">{{__('text.administration_page')}}</span>
            </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
            <i class="material-icons">&#xE5C4;</i>
        </a>
    </nav>
</div>

<div class="nav-wrapper">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{$sidebarNavDashboard ?? ''}}" href="{{route('admin.home.index')}}">
                <i class="material-icons">table_chart</i>
                <span>{{__('text.overview')}}</span>
            </a>
        </li>

        @hasrole('super-admin')
        <li class="nav-item">
            <a class="nav-link {{$sidebarNavAdministrators ?? ''}}" href="{{route('admin.users.index')}}">
                <i class="material-icons">person</i>
                <span>{{__('text.administrators')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$sidebarNavRoles ?? ''}}" href="{{route('admin.roles.index')}}">
                <i class="material-icons">person</i>
                <span>{{__('text.roles')}}</span>
            </a>
        </li>
        @endhasrole
    </ul>
</div>
