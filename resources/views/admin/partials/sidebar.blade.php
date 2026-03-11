<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/admin/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/admin/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
           <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">
            <span>Menu</span>
            </li>

            @foreach($menus as $menu)

            <li class="nav-item">

            {{-- Parent Menu with Children --}}
            @if($menu->children->count())

            <a class="nav-link menu-link" 
            href="#menu{{$menu->id}}" 
            data-bs-toggle="collapse">

            <i class="{{$menu->icon}}"></i>
            <span>{{$menu->title}}</span>

            </a>

            <div class="collapse menu-dropdown" id="menu{{$menu->id}}">
            <ul class="nav nav-sm flex-column">

            @foreach($menu->children as $child)

            <li class="nav-item">
            <a href="{{ route($child->route_name) }}" class="nav-link">
            {{$child->title}}
            </a>
            </li>

            @endforeach

            </ul>
            </div>

            {{-- Parent Menu Without Children --}}
            @else

            <a class="nav-link" href="{{ route($menu->route_name) }}">
            <i class="{{$menu->icon}}"></i>
            <span>{{$menu->title}}</span>
            </a>

            @endif

            </li>

            @endforeach

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>