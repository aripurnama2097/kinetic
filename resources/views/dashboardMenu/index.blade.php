@extends('layouts.main')

@section('section')
 
<style>
.blink {
           /* original color */
           background: white;
           color: white;
            animation: blinker 1s linear infinite !important;
  /* color: red; */
            }

        @keyframes blinker {
        50% {
            /* opacity: 0; */
            color: white;
            background: red;
            
        
        }
}
</style>
<div class="page">

   
  <div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none text-white">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
              Overview
            </div>
            <h2 class="page-title">
             Dashboard
            </h2>
          </div>
          
          <!-- Page title actions -->
        
        </div>
      </div>
    </div>

    <!-- START Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
  
          <div class="col-sm-6 col-lg-3">
            <div class="card blink">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div style="font-size:15px" class="subheader text-white">Problem Found</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                      <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Problem Found</a>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item active" href="#">Last 7 days</a>
                        <a class="dropdown-item" href="#">Last 30 days</a>
                        <a class="dropdown-item" href="#">Last 3 months</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="h1 mb-3">75%</div>
                <div class="d-flex mb-2">
                  <div>Conversion rate</div>
                  <div class="ms-auto">
                    <span class="text-green d-inline-flex align-items-center lh-1">
                      7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
                    </span>
                  </div>
                </div>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                    <span class="visually-hidden">75% Complete</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Revenue</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                      <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item active" href="#">Last 7 days</a>
                        <a class="dropdown-item" href="#">Last 30 days</a>
                        <a class="dropdown-item" href="#">Last 3 months</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <div class="h1 mb-0 me-2">$4,300</div>
                  <div class="me-auto">
                    <span class="text-green d-inline-flex align-items-center lh-1">
                      8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
                    </span>
                  </div>
                </div>
              </div>
              <div id="chart-revenue-bg" class="chart-sm"></div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">New clients</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                      <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item active" href="#">Last 7 days</a>
                        <a class="dropdown-item" href="#">Last 30 days</a>
                        <a class="dropdown-item" href="#">Last 3 months</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <div class="h1 mb-3 me-2">6,782</div>
                  <div class="me-auto">
                    <span class="text-yellow d-inline-flex align-items-center lh-1">
                      0% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg>
                    </span>
                  </div>
                </div>
                <div id="chart-new-clients" class="chart-sm"></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Active users</div>
                  <div class="ms-auto lh-1">
                    <div class="dropdown">
                      <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item active" href="#">Last 7 days</a>
                        <a class="dropdown-item" href="#">Last 30 days</a>
                        <a class="dropdown-item" href="#">Last 3 months</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <div class="h1 mb-3 me-2">2,986</div>
                  <div class="me-auto">
                    <span class="text-green d-inline-flex align-items-center lh-1">
                      4% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
                    </span>
                  </div>
                </div>
                <div id="chart-active-users" class="chart-sm"></div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row row-cards">          
            </div>
          </div>
  
          <div class="col-12">
            <div class="card card-md">
              <div class="card-stamp card-stamp-lg">
                <div class="card-stamp-icon bg-primary">
                  <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" /><path d="M10 10l.01 0" /><path d="M14 10l.01 0" /><path d="M10 14a3.5 3.5 0 0 0 4 0" /></svg>
                </div>
              </div>
            </div>
          </div>
  
        </div>
      </div>
  </div>
    {{-- <======END PAGE BODY==============> --}}
  </div>
</div>


@endsection