<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                {{-- @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('administrator.index')}}" class="font-bold text-lg">{{__('Administrador')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}" class="font-bold text-lg">{{__('Sitio Web')}}</a>
                </li>
                @if ((((isset(auth()->user()->userRole) && !is_null(auth()->user()->userRole) && auth()->user()->userRole->role->name !== 'Jefe'))) || (isset(auth()->user()->user_type_id) && auth()->user()->user_type_id == 1))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('operability.index')}}" class="font-bold text-lg">{{__('Ubicaciones')}}</a>
                </li>
                @endif

            </ul>
        </nav>
    </div>

</aside>
