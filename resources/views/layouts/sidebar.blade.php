<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard">SIADER</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/dashboard">S</a>
        </div>
        <ul class="sidebar-menu">



            <li class="active"><a class="nav-link" href="/dashboard"><i class="far fa-file"></i>
                    <span>Dashboard</span></a></li>

            @foreach (SiteHelpers::main_menu() as $mm)

            <li class="dropdown @if (Request::segment(1) == $mm->url) active @endif">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{$mm->icon}}"></i>
                    <span>{{$mm->nama_menu}}</span></a>
                <ul class=" dropdown-menu">
                    @foreach (SiteHelpers::sub_menu() as $sm)
                    @if ($sm->master_menu == $mm->id)
                    <li @if (Request::segment(1).''.Request::segment(1)==$sm->url)class="active" @endif><a
                            class="nav-link" href="{{url($sm->url)}}">{{$sm->nama_menu}}</a>
                    </li>
                    @endif
                    @endforeach





                </ul>
            </li>

            @endforeach




    </aside>
</div>