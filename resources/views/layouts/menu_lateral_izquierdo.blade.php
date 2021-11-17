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
                <a href="{{ route('home')}}"  onclick="loading_show();" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul> 
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">{{'Registros'}}</div>
        <ul class="pcoded-item pcoded-left-item">
          <li class="{{ @request()->routeIs('rol*') || @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') || @request()->routeIs('usuario_m*') || @request()->routeIs('prefijo') || @request()->routeIs('sexo') || @request()->routeIs('civil') || @request()->routeIs('status_m') || @request()->routeIs('status_c') || @request()->routeIs('status_f') || @request()->routeIs('status_t') || @request()->routeIs('status') || @request()->routeIs('usuario_a*') || @request()->routeIs('usuario_p*') || @request()->routeIs('banco') || @request()->routeIs('cripto') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') || @request()->routeIs('especialidad') || @request()->routeIs('consultorio') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }} ">
              <a href="javascript:void(0)" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="ti-settings"></i><b>C</b></span>
                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">{{'Configuración'}}</span>
                  <span class="pcoded-mcaret"></span>
              </a>
              <ul class="pcoded-submenu">
                @can('rol')
                  <li class="{{ @request()->routeIs('rol*') ? 'active' : ' ' }}">
                      <a href="{{ route('rol')}}" onclick="loading_show();" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-id-badge"></i><b>P</b></span>
                          <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Roles'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                  </li>
                @endcan
                  <li class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Dirección'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                        @can('pais')
                          <li class="{{ @request()->routeIs('pais') ? 'active' : ''}}">
                              <a href="{{route('pais')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'País'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('estado')
                          <li class="{{ @request()->routeIs('estado') ? 'active' : ''}}">
                              <a href="{{route('estado')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estado'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('ciudad')
                          <li class="{{ @request()->routeIs('ciudad') ? 'active' : ''}}">
                              <a href="{{ route('ciudad')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Ciudad'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('muncipio')
                          <li class="{{ @request()->routeIs('municipio') ? 'active' : ''}}">
                              <a href="{{ route('municipio')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Municipio'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('parroquia')
                          <li class="{{ @request()->routeIs('parroquia') ? 'active' : ''}}">
                              <a href="{{route('parroquia')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Parroquia'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                      </ul>
                  </li>

                  <li class="{{ @request()->routeIs('prefijo') || @request()->routeIs('sexo') || @request()->routeIs('civil') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Configuración Personas'}}</span>&nbsp;
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('prefijo') || @request()->routeIs('sexo') || @request()->routeIs('civil') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                        @can('prefijo')
                        <li class="{{ @request()->routeIs('prefijo') ? 'active' : ' ' }}">
                            <a href="{{ route('prefijo')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-id-badge"></i><b>P</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Prefijo DNI'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                        @can('sexo')
                        <li class="{{ @request()->routeIs('sexo') ? 'active' : ' ' }}">
                            <a href="{{ route('sexo')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-minus"></i><b>S</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Sexo'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                        @can('civil')
                        <li class="{{ @request()->routeIs('civil') ? 'active' : ' ' }}">
                            <a href="{{ route('civil')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-minus"></i><b>EC</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Estado Civil'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                  </li>
                  <li class="{{ @request()->routeIs('status_m') || @request()->routeIs('status_c') || @request()->routeIs('status_f') || @request()->routeIs('status_t') || @request()->routeIs('status') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Estatus'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('status_m') || @request()->routeIs('status_c') || @request()->routeIs('status_f') || @request()->routeIs('status_t') || @request()->routeIs('status') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                          <li class="{{ @request()->routeIs('status') ? 'active' : ''}}">
                              <a href="{{route('status')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estatus'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          @can('status_c')  
                          <li class="{{ @request()->routeIs('status_c') ? 'active' : ''}}">
                              <a href="{{route('status_c')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estatus Consulta'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          @endcan
                          @can('status_f')
                          <li class="{{ @request()->routeIs('status_f') ? 'active' : ''}}">
                              <a href="{{route('status_f')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estatus Factura'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          @endcan
                          @can('status_m')
                          <li class="{{ @request()->routeIs('status_m') ? 'active' : ''}}">
                              <a href="{{route('status_m')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estatus Médico'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          @endcan
                          @can('status_t')                       
                          <li class="{{ @request()->routeIs('status_t') ? 'active' : ''}}">
                              <a href="{{route('status_t')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Estatus Tasas'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                          @endcan
                      </ul>
                  </li>
                  <li class="{{ @request()->routeIs('usuario_m*') || @request()->routeIs('usuario_a*') || @request()->routeIs('usuario_p*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Usuarios'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('usuario_m*') || @request()->routeIs('usuario_a*') || @request()->routeIs('usuario_p*') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                        @can('usuario_m')
                          <li class="{{ @request()->routeIs('usuario_m*') ? 'active' : ''}}">
                              <a href="{{route('usuario_m')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Médicos'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('usuario_a')
                          <li class="{{ @request()->routeIs('usuario_a*') ? 'active' : ''}}">
                              <a href="{{route('usuario_a')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Asistente'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('usuario_p')
                          <li class="{{ @request()->routeIs('usuario_p*') ? 'active' : ''}}">
                              <a href="{{route('usuario_p')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                  <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{'Paciente'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                         
                      </ul>
                  </li>
                  <li class="{{ @request()->routeIs('banco') || @request()->routeIs('cripto') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Cuentas'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('banco') || @request()->routeIs('cripto') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                       @can('banco')
                        <li class="{{ @request()->routeIs('banco') ? 'active' : ' ' }}">
                            <a href="{{ route('banco')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-minus"></i><b>B</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Bancos'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                        @can('cripto')
                        <li class="{{ @request()->routeIs('cripto') ? 'active' : ' ' }}">
                            <a href="{{ route('cripto')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-minus"></i><b>C</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Criptos'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                        @can('billetera')
                          <li class="{{ @request()->routeIs('billetera') ? 'active' : ' ' }}">
                              <a href="{{ route('billetera')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-minus"></i><b>B</b></span>
                                  <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Billeteras Criptos'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('cuenta_banco')
                          <li class="{{ @request()->routeIs('cuenta_banco') ? 'active' : ' ' }}">
                              <a href="{{ route('cuenta_banco')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-minus"></i><b>CB</b></span>
                                  <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Cuentas de Banco'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                         
                      </ul>
                  </li>
                  <li class="{{ @request()->routeIs('especialidad') || @request()->routeIs('consultorio') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                          <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                          <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">{{'Confg. Medico'}}</span>
                          <span class="pcoded-mcaret"></span>
                      </a>
                      <ul class="{{ @request()->routeIs('especialidad') || @request()->routeIs('consultorio') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                       @can('especialidad')
                        <li class="{{ @request()->routeIs('especialidad') ? 'active' : ' ' }}">
                            <a href="{{ route('especialidad')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-minus"></i><b>EM</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Especialidades Medicas'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                        @can('consultorio')
                        <li class="{{ @request()->routeIs('consultorio') ? 'active' : ' ' }}">
                            <a href="{{ route('consultorio')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="ti-minus"></i><b>C</b></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Consultorios'}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        @endcan
                       {{-- @can('billetera')
                          <li class="{{ @request()->routeIs('billetera') ? 'active' : ' ' }}">
                              <a href="{{ route('billetera')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-minus"></i><b>B</b></span>
                                  <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Billeteras Criptos'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan
                        @can('cuenta_banco')
                          <li class="{{ @request()->routeIs('cuenta_banco') ? 'active' : ' ' }}">
                              <a href="{{ route('cuenta_banco')}}" onclick="loading_show();" class="waves-effect waves-dark">
                                  <span class="pcoded-micon"><i class="ti-minus"></i><b>CB</b></span>
                                  <span class="pcoded-mtext" data-i18n="nav.dash.main">{{'Cuentas de Banco'}}</span>
                                  <span class="pcoded-mcaret"></span>
                              </a>
                          </li>
                        @endcan --}}                        
                      </ul>
                  </li>
              </ul>
          </li>
      </ul>
      <ul class="pcoded-item pcoded-left-item">
        <li class="{{ @request()->routeIs('urologia*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }} ">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">{{'Historias Clínicas'}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
              @can('urologia')
              <li class="{{ @request()->routeIs('urologia*') ? 'active' : ''}}">
                <a href="{{ route('urologia')}}" onclick="loading_show();" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                  <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">{{'Urología'}}</span>
                  <span class="pcoded-mcaret"></span>
                </a>
              </li>
              @endcan
            </ul>
        </li>        
      </ul>
    </div>
</nav>