<header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl ml-2">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 style="font-size:30px">KINETIC</h1>
      {{-- class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href="#" class="style:font-weight;font-size:20px">KINETIC --}}
          <!-- <span class="font-6 d-block font-weight-light"> Electronics Services</span> -->
          <!-- <img src="./static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image"> -->
        </a>
      </h1>
      <div class="navbar-nav flex-row order-md-last">
        <div class="d-none d-md-flex">
          {{-- <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
       data-bs-placement="bottom">
           
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
       data-bs-placement="bottom">
           
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
          </a> --}}
          <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
              <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
              {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
              <span class="badge bg-red"></span> --}}
            </a>
            
          </div>
        </div>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            {{-- <span class="avatar avatar-sm" style="background-image: url()"></span> --}}
            <div class="d-none d-xl-block ps-2">
              @auth
            <div class="btn btn-success  btn-sm text-light float-right  ">   <i class="ti ti-people">   </i>  {{auth()->user()->name}}  </div>
              <!-- <div class="mt-1 small text-muted">UI Designer</div> -->
              @endauth
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            {{-- <a href="{{url('/logout')}}" class="dropdown-item">Logout</a>
            --}}
             <form action="{{url('/logout')}}" method="post">
            @csrf
            <button type="submit" class="dropdown-item "> 
           Logout</a></button>
          </form>
          </div>
        </div>
      </div>

      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{url('dashboardMenu')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg> -->
                </span>
                <span  style="font-size:18px" class="nav-link-title">
                  Home
                </span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                {{-- <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                
                </span> --}}
                <span style="font-size:16px" class="nav-link-title">
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
                      <a  href="{{url('/schedule_tentative')}}" class="dropdown-item dropdown-toggle "  >
                       Schedule Tentative
                      </a>
                  </div>
                  <div class="dropdown-menu-column">                 
                    <a  href="{{url('/schedule')}}" class="dropdown-item dropdown-toggle"  >
                     Schedule
                    </a>
                </div>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                  <i class="ti ti-package"></i>
                </span>
                <span style="font-size:16px" class="nav-link-title">
                  MC Menu
                </span>
              </a>
              <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">                     
                    <div class="dropend">
                      <a  href ="{{url('/partlist')}}" >
                        MC Part List               
                      </a>                 
                    </div>
                   
                  </div>
                
                </div>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./form-elements.html" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                </span>
                <span  style="font-size:16px" class="nav-link-title">
                  Repacking
                </span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <i class="ti ti-package"></i>
                </span>
                <span style="font-size:16px" class="nav-link-title">
                  Shipping
                </span>
              </a>
              <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="./activity.html">
                      Activity
                    </a>
                    <a class="dropdown-item" href="./gallery.html">
                      Gallery
                    </a>
                   
                    <a class="dropdown-item" href="./pricing-table.html">
                      Pricing table
                    </a>
                    <a class="dropdown-item" href="./faq.html">
                      FAQ
                      <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                    </a>
                    <a class="dropdown-item" href="./users.html">
                      Users
                    </a>
                    <a class="dropdown-item" href="./license.html">
                      License
                    </a>
                    <a class="dropdown-item" href="./logs.html">
                      Logs
                      <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                    </a>
                  </div>
                 
                </div>
              </div>
            </li>
            <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M14 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                </span>
                <span  style="font-size:16px" class="nav-link-title">
                General
                </span>
              </a>
              <div class="dropdown-menu">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <a class="dropdown-item" href="./layout-horizontal.html">
                     Problem Found
                    </a>
                    <a class="dropdown-item" href="./layout-boxed.html">
                      Borrow Menu
                      <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                    </a>
                 
                  </div>
                  
                </div>
              </div>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                
                </span>
                <span style="font-size:16px" class="nav-link-title">
                  KIT Service Monitor
                </span>
              </a>
          
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./icons.html" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
               
                </span>
                <span  style="font-size:16px" class="nav-link-title">
                  KIT SSO
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>