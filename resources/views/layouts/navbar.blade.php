
{{-- <header class="navbar navbar-expand-md d-print-none"  data-bs-theme="dark"> --}}
{{-- <div class="page"> --}}
    {{-- @include('layouts.css')
    @include('layouts.script') --}}
  
      <body >
  
        <div class="page">
          <!-- Navbar -->
          {{-- <header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none"> --}}
          <header class="navbar navbar-expand-md navbar-dark d-print-none">
            <div class="container-xl">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">
                    <img src ="{{asset('../public/css/logojkei.png')}}" alt="Logo JKEI" width="200px">
                </a>
              </h1>
              <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                  <div class="btn-list">
                    <a class="btn btn-dark" target="_blank" rel="noreferrer" style="font-size:30px">                
                    KINETIC
                    </a>
                  </div>
                </div>
               
                <div class="nav-item dropdown">
                  <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm mr-2">  <i class="ti ti-user-circle mr-1"></i></span>
                    @auth
                    <div style="font-weight:bold;font-size:15px" class="text-white float-right d-flex justify-content-end ">
                        {{ auth()->user()->name }}
                    </div>    
                   @endauth
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
            </div>
          </header>

          <header class="navbar-expand-md ">
            <div class="collapse navbar-collapse" id="navbar-menu">
              <div class="navbar navbar-dark">
                <div class="container-xl">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboardMenu') }}">
                            <i class="ti ti-home-ribbon mr-2"></i>
                            <span style="font-size:16px" class="nav-link-title">  
                                Home
                            </span>
                        </a>
                    </li>

                  {{-- ====ADMIN || ADMIN PLANNING==== --}}
                  @if(Auth::user()->role === 'Super Admin'|| Auth::user()->role === 'Admin' ||Auth::user()->role === 'Admin Planning') 
                    <li class="nav-item dropdown">
                      <a class="nav-link " href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                         <i class="ti ti-book-upload mr-2"></i>
                         <span style="font-size:14px" class="nav-link-title">  
                               Item Master & Schedule
                         </span>
                          
                       </a>
                       <div class="dropdown-menu">
                           <div class="dropdown-menu-columns ">
                               <div class="dropdown-menu-column">
                                   <div class="dropend">
                                       <a class="dropdown-item " href="{{url('/stdpack')}}" >
                                           Item Master                  
                                       </a>                  
                                   </div>
                               </div>
                               <div class="dropdown-menu-column ">
                                 <a href="{{ url('/schedule_tentative') }}" class="dropdown-item  ">
                                      Master Data Schedule
                                 </a>
                             </div>
                               <div class="dropdown-menu-column ">
                                   <a href="{{ url('/schedule_tentative/result') }}" class="dropdown-item  ">
                                       Schedule Tentative
                                   </a>
                               </div>
                               <div class="dropdown-menu-column">
                                   <a href="{{ url('/schedule') }}" class="dropdown-item ">
                                       Schedule Release
                                   </a>
                               </div>
                           </div>
                       </div>
                     </li>

       
                   {{-- MC ISSUE --}}
                   <li class="nav-item dropdown">
                     <a class="nav-link " href="#navbar-base" data-bs-toggle="dropdown"
                         data-bs-auto-close="outside" role="button" aria-expanded="false">
                         {{-- <span class="nav-link-icon d-md-none d-lg-inline-block">
                          
                           
                         </span> --}}<i class="ti ti-package mr-2"></i>
                         <span style="font-size:15px" class="nav-link-title">  
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
                                   <a class="dropdown-item " href="{{ url('/partlist/inhouse') }}">
                                       In House Process
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="dropdown-menu-columns">
                           <div class="dropdown-menu-column">
                               <div class="dropend">
                                   <a class="dropdown-item " href="{{ url('/partlist/inhouse_data') }}">
                                       In House Data
                                   </a>
                               </div>
                           </div>
                       </div>
                     </div>
                   </li>
                               
                  
                   <li class="nav-item dropdown">
                       <a class="nav-link " href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                      
                           {{-- <span class="nav-link-icon d-md-none d-lg-inline-block">
                             
                           </span> --}}
                           <i class="ti ti-transfer-in mr-2"></i>
                           <span style="font-size:16px" class="nav-link-title">     
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
                         <div class="dropdown-menu-columns">
                             <div class="dropdown-menu-column">
                                 <div class="dropend">
                                     <a class="dropdown-item " href="{{ url('/repacking/cancelation') }}">
                                         Cancelation Data
                                     </a>
                                 </div>
                             </div>
                         </div>
                       </div>
                   </li>
       
                   {{-- SHIPPING MODUL --}}
                   <li class="nav-item dropdown">
                       <a class="nav-link " href="#navbar-extra" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                       
                           <i class="ti ti-transfer-out mr-2"></i>
                           <span style="font-size:16px" class="nav-link-title">    
                               Finish Good
                           </span>
                       </a>
                       <div class="dropdown-menu ">
                           <div class="dropdown-menu-columns">
                               <div class="dropdown-menu-column">
                                   <a class="dropdown-item" href="{{url('/finishgood')}}">
                                       Packing Menu
                                   </a>
                                   <a class="dropdown-item" href="{{url('/finishgood/scanoutData')}}">
                                       Data FinishGood
                                   </a>           
                                   {{-- <a class="dropdown-item" href="{{url('/finishgood/view_check')}}">
                                       Scan Out Check
                                 </a>   --}}
                                 <a class="dropdown-item" href="{{url('/finishgood/masterlist')}}">
                                     Download Master List
                               </a>  
                               </div>
       
                           </div>
                       </div>
                   </li>
       
                   {{-- GENERAL MODUL --}}
                   <li class="nav-item dropdown ">                
                       <a class="nav-link " href="#navbar-layout" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">  
                           <i class="ti ti-chalkboard mr-2"></i>
                           <span style="font-size:15px" class="nav-link-title">
                               Problem & Borrowing
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
                                   </a>
                                   <a href="{{url('borrow/cancelation')}}" class="dropdown-item text-dark"><i class="ti ti-circle-letter-x"></i>
                                      Cancelation Part
                                 </a>
                               </div>
                           </div>
                       </div>
                   </li>
       
                   {{-- KSM --}}
                   <li class="nav-item  ">        
                       <a class="nav-link"  href ="{{url('/kitmonitoring')}}" >
                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                         </span>
                      <i class="ti ti-device-desktop mr-1"></i>
                           <span style="font-size:14px" class="nav-link-title">  
                               KIT Monitor
                           </span>
                       </a>
       
                   </li>
                   
                   {{-- KIT SSO --}}
                   <li class="nav-item">
                       <a class="nav-link" href="{{url('kitmonitoring/shippout')}}">
                           <span class="nav-link-icon d-md-none d-lg-inline-block">
                           </span>
                           {{-- <i class="ti ti-device-desktop mr-2"></i> --}}
                           <span style="font-size:14px" class="nav-link-title">   
                               KIT SSO
                           </span>
                       </a>
                   </li>
       
                   {{-- USER SETTING --}}
                   @if(Auth::user()->role === 'Super Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/user_setting')}}">
                                <span style="font-size:16px" class="nav-link-title">
                                    User Setting
                                </span>
                                <i class="ti ti-user-plus mr-2"></i>
                            </a>
                        </li>
                  @endif

                   {{-- GUIDANCE --}}
                   <li class="nav-item">
                     <a class="nav-link  bg-primary" href="{{asset('')}}storage/WI/KINETIC_GUIDANCE.pdf">                  
                         <span style="font-size:16px" class="nav-link-title">
                            Guidance
                         </span>
                     </a>
                  </li>   
                 @endif
               
                      {{-- ==== ADMIN MC=========== --}}
                      <?php if (Auth::user()->role === 'user' || Auth::user()->role === 'Admin MC') { ?>
                        {{-- SCHDEULE RELEASE --}}
                      <li class="nav-item">
                         <a class="nav-link" href="{{ url('/schedule/release_schedule') }}">
                             <i class="ti ti-calendar-minus mr-2"></i>
                             <span style="font-size:14px" class="nav-link-title">  
                                 Schedule Release 
                             </span>
                         </a>
                      </li>
           
                       {{-- MC ISSUE --}}
                       <li class="nav-item ">
                         <a class="nav-link" href="{{ url('/partlist') }}"  class="text-light">
                             <i class="ti ti-file-text mr-2"></i>
                             <span style="font-size:15px" class="nav-link-title">  
                               MC Partlist
                             </span>
                         </a>
                      </li>
                     
           
                      <li class="nav-item">
                         <a  class="nav-link"href="{{ url('/partlist/view') }}"  class="text-light">
                              {{-- <span class="nav-link-icon d-md-none d-lg-inline-block">
                             
                             </span> --}}
                           <i class="ti ti-package mr-2"></i>
                             <span style="font-size:15px" class="nav-link-title">  
                               MC Data
                             </span>
                         </a>
                      </li>
                      <li class="nav-item">
                         <a class="nav-link bg-primary" href="{{asset('')}}storage/WI/KINETIC_GUIDANCE.pdf">
                             {{-- <span class="nav-link-icon d-md-none d-lg-inline-block">
                             </span> --}}
                           
                             <span style="font-size:16px" class="nav-link-title">
                                Guidance
                             </span>
                             {{-- <i class="ti ti-user-plus mr-2"></i> --}}
                         </a>
                      </li>
                     <?php } ?>
           
                     {{-- ====ADMIN QA==== --}}
                     <?php if (Auth::user()->role === 'user' || Auth::user()->role === 'Admin QA' ||Auth::user()->role === 'Admin QC') { ?>
                        {{-- GENERAL MENU --}}                 
                     <li class="nav-item dropdown ml-3">
                         <a class="nav-link" href="{{ url('/schedule/release_schedule') }}" >
                              <span style="font-size:15px" >  <i class="ti ti-calendar-minus mr-2"></i>
                                  Schedule Release
                              </span>
                          </a>               
                     </li>
                     <li class="nav-item ">
                             <a class="nav-link"  href="{{url('/problem')}}">
                                 <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    
                                 </span>
                                 <span style="font-size:15x" class="nav-link-title"><i class="ti ti-exclamation-circle"></i>
                                     Problem Found
                                 </span>
                             </a>
                          
                         </li>
           
                         <li class="nav-item ">
                             <a class="nav-link"  href="{{url('/borrow')}}">
                                 <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    
                                 </span>
                                 <span style="font-size:15x" class="nav-link-title"><i class="ti ti-arrow-big-right-lines-filled"></i>
                                     Borrow Menu
                                 </span>
                             </a>
                           
                         </li>
           
                         <li class="nav-item">
                             <a class="nav-link" href ="{{url('/kitmonitoring')}}">
                              
                                 <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 </span>
                                 <i class="ti ti-device-desktop mr-2"></i>
                                 <span style="font-size:16px" class="nav-link-title">
                                    KIT Service Monitor
                                </span>
                              
                                 {{-- <span style="font-size:15px" class="nav-link-title">   <i class="ti ti-device-desktop"></i>
                                     KIT Service Monitor
                                 </span> --}}
                             </a>
           
                         </li>
           
                         <li class="nav-item">
                             <a class="nav-link bg-primary ml-3" href="{{asset('')}}storage/WI/KINETIC_GUIDANCE.pdf">
                               
                                 <span style="font-size:16px" class="nav-link-title">
                                    Guidance
                                 </span>
                                 {{-- <i class="ti ti-user-plus mr-2"></i> --}}
                             </a>
                          </li>
                      
                     <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </header>
          
        
      </body>
    </html>

