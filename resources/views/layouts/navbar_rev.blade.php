
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
 
  <body >
    <script src="./dist/js/demo-theme.min.js?1691487027"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          {{-- <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1> --}}
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
           
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

                  {{-- ====ADMIN || ADMIN PLANNING==== --}}
                  <?php if (Auth::user()->role === 'admin'||Auth::user()->role === 'Admin Planning') { ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link " href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                           <span style="font-size:13px" >  <i class="ti ti-book-upload"></i>
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
                                   <a href="{{ url('/schedule_tentative') }}" class="dropdown-item  ">
                                       Schedule Tentative
                                   </a>
                               </div>
                               <div class="dropdown-menu-column">
                                   <a href="{{ url('/schedule') }}" class="dropdown-item ">
                                       Schedule Generate
                                   </a>
                               </div>
                           </div>
                       </div>
                     </li>
 
                     
                  <li class="nav-item dropdown ml-3">
                         <a class="text-white"href="{{ url('/schedule/release_schedule') }}" >
                              <span style="font-size:13px" >  <i class="ti ti-calendar-minus mr-2"></i>
                                  Schedule Release
                              </span>
                          </a>
                       
                   </li>
                   {{-- MC ISSUE --}}
                   <li class="nav-item dropdown">
                     <a class="nav-link " href="#navbar-base" data-bs-toggle="dropdown"
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
                           {{-- <div class="dropdown-menu-columns">
                             <div class="dropdown-menu-column">
                                 <div class="dropend">
                                     <a class="dropdown-item " href="{{ url('/repacking/viewscan') }}">
                                         Menu ScanIn
                                     </a>
                                 </div>
                             </div>
                         </div> --}}
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
                                         Cancelation
                                     </a>
                                 </div>
                             </div>
                         </div>
                       </div>
                   </li>
 
                   <li class="nav-item dropdown">
                       <a class="nav-link " href="#navbar-extra" data-bs-toggle="dropdown"
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
                       <a class="nav-link " href="#navbar-layout" data-bs-toggle="dropdown"
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
                                   <a href="{{url('borrow/cancelation')}}" class="dropdown-item text-dark"><i class="ti ti-circle-letter-x"></i>
                                      Cancelation Part
                                 </a>
 
                               </div>
 
                           </div>
                       </div>
                   </li>
 
                   {{-- KSM --}}
                   <li class="nav-item dropdown">
                       <a  href ="{{url('/kitmonitoring')}}" class="text-light">
                        
                           <span class="nav-link-icon d-md-none d-lg-inline-block">
                           </span>
                           <span style="font-size:16px" class="nav-link-title">   <i class="ti ti-device-desktop"></i>
                               KIT Monitor
                           </span>
                       </a>
 
                   </li>
                   
                   {{-- KIT SSO --}}
                   <li class="nav-item">
                       <a class="nav-link" href="{{url('kitmonitoring/shippout')}}">
                           <span class="nav-link-icon d-md-none d-lg-inline-block">
                           </span>
                           <span style="font-size:18px" class="nav-link-title">   <i class="ti ti-package-export"></i>
                               KIT SSO
                           </span>
                       </a>
                   </li>
 
                   {{-- USER SETTING --}}
                   <li class="nav-item">
                     <a class="nav-link" href="{{url('/user_setting')}}">
                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                         </span>
                         <span style="font-size:16px" class="nav-link-title"><i class="ti ti-user-plus"></i>
                             User Setting
                         </span>
                     </a>
                  </li>
                  <?php } ?>

              </ul>
            </div>
          </div>
        </div>
      </header>
      
    </div>
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <label class="form-label">Report type</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Simple</span>
                      <span class="d-block text-secondary">Provide only basic data needed for the report</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Advanced</span>
                      <span class="d-block text-secondary">Insert charts and additional advanced analyses to be inserted in the report</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8">
                <div class="mb-3">
                  <label class="form-label">Report url</label>
                  <div class="input-group input-group-flat">
                    <span class="input-group-text">
                      https://tabler.io/reports/
                    </span>
                    <input type="text" class="form-control ps-0"  value="report-01" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Visibility</label>
                  <select class="form-select">
                    <option value="1" selected>Private</option>
                    <option value="2">Public</option>
                    <option value="3">Hidden</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Client name</label>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Reporting period</label>
                  <input type="date" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Additional information</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create new report
            </a>
          </div>
        </div>
      </div>
    </div>
  
  </body>
</html>