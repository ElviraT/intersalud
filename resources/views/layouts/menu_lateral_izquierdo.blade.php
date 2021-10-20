<nav class="pcoded-navbar">
  <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{ asset('assets/images/avatar-4.jpg')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{auth()->user()->name}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="#"><i class="ti-user"></i>{{'Perfil'}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti-layout-sidebar-left"></i>                  
                            {{ 'Logout' }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>   
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">{{'Inicio'}}</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ @request()->routeIs('home') ? 'active' : ' ' }}">
                <a href="{{ route('home')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul> 
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">{{'Registros'}}</div>
        <ul class="pcoded-item pcoded-left-item">
          <li class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') || @request()->routeIs('usuario_m*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }} ">
              <a href="javascript:void(0)" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="ti-settings"></i><b>C</b></span>
                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">{{'Configuración'}}</span>
                  <span class="pcoded-mcaret"></span>
              </a>
              <ul class="pcoded-submenu">
                  <li class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Dirección'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                          <li class="{{ @request()->routeIs('pais') ? 'active' : ''}}">
                              <a href="{{route('pais')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'País'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('estado') ? 'active' : ''}}">
                              <a href="{{route('estado')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estado'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('ciudad') ? 'active' : ''}}">
                              <a href="{{ route('ciudad')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Ciudad'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('municipio') ? 'active' : ''}}">
                              <a href="{{ route('municipio')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Municipio'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('parroquia') ? 'active' : ''}}">
                              <a href="{{route('parroquia')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Parroquia'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="{{ @request()->routeIs('usuario_m*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Usuarios'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('usuario_m*') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                          <li class="{{ @request()->routeIs('usuario_m*') ? 'active' : ''}}">
                              <a href="{{route('usuario_m')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Médicos'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                         {{-- <li class="{{ @request()->routeIs('estado') ? 'active' : ''}}">
                              <a href="{{route('estado')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estado'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('ciudad') ? 'active' : ''}}">
                              <a href="{{ route('ciudad')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Ciudad'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('municipio') ? 'active' : ''}}">
                              <a href="{{ route('municipio')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Municipio'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          <li class="{{ @request()->routeIs('parroquia') ? 'active' : ''}}">
                              <a href="{{route('parroquia')}}" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Parroquia'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>--}}
                      </ul>
                  </li>
              </ul>
          </li>
      </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ @request()->routeIs('urologia') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }} ">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">{{'Historias Clínicas'}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                  <li class=" ">
                    <a href="{{ route('urologia')}}" class="waves-effect waves-dark">
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