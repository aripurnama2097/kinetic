<header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="ml-3"style="font-size:30px">KINETIC</h1>
        

        <div class="navbar-nav flex-row  order-md-last">

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    {{-- <span class="avatar avatar-sm" style="background-image: url()"></span> --}}
                    <div class="d-none d-xl-block ps-2">
                        @auth
                            <div style="font-weight:bold;font-size:15px" class="text-white float-right d-flex justify-content-end mr-3  ">
                                <i class="ti ti-users mr-1"> </i> {{ auth()->user()->name }}
                            </div>
                            <!-- <div class="mt-1 small text-muted">UI Designer</div> -->
                        @endauth
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item ">
                            logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ url('dashboardMenu') }}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                          
                          </span>
                          <span style="font-size:20px" class="nav-link-title">  <i class="ti ti-home-ribbon"></i>
                              Home
                          </span>
                      </a>
                  </li>
                  <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
              
                <span style="font-size:18px" >  <i class="ti ti-calendar-minus mr-2"></i>
                              Master Schedule
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns ">
                              <div class="dropdown-menu-column">

                                  <div class="dropend">
                      <a class="dropdown-item " href="{{url('/stdpack')}}" >
                                          Setup Standard Pack
                      
                                      </a>
                    
                                  </div>

                              </div>
                              <div class="dropdown-menu-column ">
                                  <a href="{{ url('/schedule_tentative') }}" class="dropdown-item dropdown-toggle ">
                                      Schedule Tentative
                                  </a>
                              </div>
                              <div class="dropdown-menu-column">
                                  <a href="{{ url('/schedule') }}" class="dropdown-item dropdown-toggle">
                                      Schedule
                                  </a>
                              </div>
                          </div>
                      </div>
                  </li>




                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                           
                            
                          </span>
                          <span style="font-size:18px" class="nav-link-title">  <i class="ti ti-package"></i>
                              MC Menu
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <div class="dropend">
                                      <a class="dropdown-item " href="{{ url('/partlist') }}">
                                          MC Issue
                                      </a>
                                  </div>
                              </div>
                          </div>
                          <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <div class="dropend">
                                    <a class="dropdown-item " href="{{ url('/partlist/view') }}">
                                        MC Data
                                    </a>
                                </div>
                            </div>
                        </div>
                          <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <div class="dropend">
                                    <a class="dropdown-item " href="{{ url('/partlist') }}">
                                        In House Process
                                    </a>
                                </div>
                            </div>
                        </div>
                      </div>
                  </li>

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                     
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                            
                          </span>
                          <span style="font-size:18px" class="nav-link-title">     <i class="ti ti-transfer-in"></i>
                              Repacking
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <div class="dropend">
                                      <a class="dropdown-item " href="{{ url('/repacking') }}">
                                          Menu Print
                                      </a>
                                  </div>
                              </div>
                          </div>
                          <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <div class="dropend">
                                    <a class="dropdown-item " href="{{ url('/repacking/kitdata') }}">
                                        KIT Data
                                    </a>
                                </div>
                            </div>
                        </div>
                      </div>
                  </li>





                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                      
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                            
                          </span>
                          <span style="font-size:18px" class="nav-link-title">    <i class="ti ti-transfer-out"></i>
                              Shipping
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{url('/finishgood')}}">
                                      Packing Menu
                                  </a>
                                  <a class="dropdown-item" href="{{url('/finishgood/scanoutData')}}">
                                      Data FinishGood
                                  </a>           
                                  <a class="dropdown-item" href="{{url('/finishgood/view_check')}}">
                                      Scan Out Check
                                </a>  
                              </div>

                          </div>
                      </div>
                  </li>


                  <li class="nav-item active dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                             
                          </span>
                          <span style="font-size:18px" class="nav-link-title"><i class="ti ti-chalkboard"></i>
                              General
                          </span>
                      </a>
                      <div class="dropdown-menu">
                          <div class="dropdown-menu-columns">
                              <div class="dropdown-menu-column">
                                  <a class="dropdown-item" href="{{url('/problem')}}">
                                      Problem Found
                                  </a>
                                  <a class="dropdown-item" href="{{url('/borrow')}}">
                                      Borrow Menu
                                      <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                                  </a>

                              </div>

                          </div>
                      </div>
                  </li>

                  <li class="nav-item dropdown">
                      <a  href ="{{url('/kitmonitoring')}}" class="text-light">
                       
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                          </span>
                          <span style="font-size:16px" class="nav-link-title">   <i class="ti ti-device-desktop"></i>
                              KIT Service Monitor
                          </span>
                      </a>

                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="./icons.html">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                          </span>
                          <span style="font-size:18px" class="nav-link-title">   <i class="ti ti-package-export"></i>
                              KIT SSO
                          </span>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./icons.html">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->

                        </span>
                        <span style="font-size:16px" class="nav-link-title"><i class="ti ti-user-plus"></i>
                            User Setting
                        </span>
                    </a>
                </li>
              </ul>
          </div>
      </div>
</header>
