<nav class="pcoded-navbar">
  <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{ asset('assets/images/avatar-4.jpg')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{'Admin'}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="#"><i class="ti-user"></i>{{'Perfil'}}</a>
                        <a href="#"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">{{'Inicio'}}</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="{{ route('home')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul> 
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">{{'Registros'}}</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">{{'Historias Clínicas'}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                  <li class=" ">
                    <a href="#" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                      <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">{{'Urología'}}</span>
                      <span class="pcoded-mcaret"></span>
                    </a>
                  </li>
                </ul>
            </li>        
        </ul>
    </div>
</nav>