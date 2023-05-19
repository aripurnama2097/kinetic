@extends('layouts.main')

@section('section')



<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
              Overview
            </div>
            <h2 class="page-title">
              Standard Pack
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
                <a href="#" class="btn btn-light " data-bs-toggle="modal" data-bs-target="#stdpack-upload"> <i class="ti ti-arrow-big-down-filled"></i>
                  Upload Std Pack
                </a>
              </span>
              <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#create-stdpack">
                <i class="ti ti-plus"></i>
                Create Std Pack
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
          {{-- <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Sales</div>
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
          </div> --}}
       
          {{-- <div class="col-12">
            <div class="card card-md">
              <div class="card-stamp card-stamp-lg">
                
              
              </div>
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-10">
                    <h3 class="h1">Schedule Result</h3>
                    <div class="markdown text-muted">
                    
                    </div>
                    <div class="mt-3">
                      <a href="https://tabler-icons.io" class="btn bt n-primary" target="_blank" rel="noopener">Generate Partlist</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          
          <div class="col-12">
            <div class="card rounded-1">
              <div class="card-header">
                {{-- <h3 class="card-title">Schedule</h3> --}}
              </div>

             
              <div class="card-body border-bottom py-2">
                {{-- <a href="#" class="btn btn-success d-none d-sm-inline-block btn-sm " data-bs-toggle="modal" data-bs-target="#modal-schedule">
                  <i class="ti ti-mail-forward"></i>
                  Share Schedule
                </a>
                <a href="{{url('/schedule')}}" class="btn btn-primary d-none d-sm-inline-block btn-sm " >
                  <i class="ti ti-360"></i>
                 Generate 
                </a> --}}
                @if(Session::has('success'))
                <p class="alert alert-success">{{Session::get('success')}}</p>
                @endif

                <a href="{{url('/schedule')}}" class="btn btn-info d-none d-sm-inline-block btn-sm " >
                  <i class="ti ti-360"></i>
                  Refresh
                </a>

                <button class="btn btn-danger btn-sm" id="delete-all-data" ><i class="ti ti-trash"></i>Delete Data</button>

                <a href="{{url('/schedule')}}" class="btn btn-success d-none d-sm-inline-block btn-sm " >
                  <i class="ti ti-edit"></i>
                  Change Data
                </a>
                <div class="table-responsive  rounded-1">
                  <table id="example"class="table card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-dark">
                      <tr>
                      
                        <th> No </th>
                        <th>Part Number</th>
                        <th>Part Name</th>
                        <th>Lenght</th>
                        <th>Widht</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Pack</th>
                        <th>Vendor</th>
                        <th>JKN Shelf No</th>
                        <th>MC Shelf No</th>
                        
                      
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $key => $value)
                      <tr>
                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                        <td> {{$value->partnumber}}</td>
                        <td > {{$value->partname}}</td>
                        <td> {{$value->lenght}}</td>
                        <td> {{$value->widht}}</td>
                        <td> {{$value->height}}</td>
                        <td> {{$value->weight}}</td>
                        <td> {{$value->stdpack}}</td>
                        <td> {{$value->vendor}}</td>
                          <td> {{$value->jknshelf}}</td>
                        <td> </td>
                       
                       
                      </tr>
                      @endforeach
                     
                  
                    </tbody>
                  </table>
                </div>
              </div>
            
              <div class="card-footer d-flex align-items-center">
             
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <footer class="footer footer-transparent d-print-none">
      <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
          <div class="col-lg-auto ms-lg-auto">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item"><a href="./docs/" class="link-secondary">Documentation</a></li>
              <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
              <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
              <li class="list-inline-item">
                <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Sponsor
                </a>
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-auto mt-3 mt-lg-0">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item">
                Copyright &copy; 2023
                <a href="." class="link-secondary">Tabler</a>.
                All rights reserved.
              </li>
              <li class="list-inline-item">
                <a href="./changelog.html" class="link-secondary" rel="noopener">
                  v1.0.0-beta17
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer> --}}
  </div>


  {{-- ====================,modal stdpack upload ========================================= --}}
<div class="modal modal-blur fade" id="stdpack-upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Std pack Upload</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form  action="{{url('/stdpack/upload-stdpack')}}"  enctype="multipart/form-data" method="POST" >
            @csrf  
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Upload file</label>
                    <input  type="file" class="form-control" rows="3" name="file"  id="file" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button shadow-lg" class="btn btn-light link-warning" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit" href="#" class="btn btn-primary ms-auto" >
                <i class="ti ti-plus"></i>
                Upload stdpack
              </button>
            </div>
          </form>
        </div>
    </div>
</div>


<div class="modal modal-blur fade" id="create-stdpack" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Std Pack</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
            <div class="modal-body">
              <form  action="{{url('/stdpack/create')}}"  method="POST" >
                @csrf
            <div class="mb-3">
                <label class="form-label">Item Number</label>
                <input type="text" name="itemno" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                    <label class="form-label">Part Name</label>
                    <input type="text" class="form-control" name="partname" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <label class="form-label">Lenght</label>
                    <input type="text" class="form-control"  name="lenght" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Widht</label>
                    <input type="text" class="form-control" name="widht" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">Height</label>
                        <input type="text" class="form-control" name="height" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Weight</label>
                    <input type="text" class="form-control" name="weight" required>
                    </div>
                </div>
              
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Pack</label>
                    <input type="text" class="form-control"name="pack" required>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Vendor</label>
                    <input type="text" class="form-control" name="vendor" required>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">JKN Shelf No</label>
                    <input type="text" class="form-control"  name="jknshelfno" required>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">MC Shelf No</label>
                    <input type="text" class="form-control"   name="mcshelfno" required>
                    </div>
                </div>
                <br>
                <br>
            </div>  

            <div class="modal-footer">
              <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit"  class="btn btn-primary ms-auto" >
                Create new stdpack
              </button>
          </div>
        </form>
            </div>

       
      
      
      </div>
    </div>
  </div>



<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript" src="{{asset('')}}js/TableCheckAll.js"> </script>

<script type="text/javascript">
  $(document).ready(function() {

    // $("#example").TableCheckAll();

    $('#delete-all-data').on('click', function() {
      var button = $(this);
      var selected = [];
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure you want to delete selected record(s)?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: button.data('route'),
            data: {
              'selected': selected
            },
            success: function (response, textStatus, xhr) {
              Swal.fire({
                icon: 'success',
                  title: response,
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Yes'
              }).then((result) => {
                window.location='/posts'
              });
            }
          });
        }
      });
    });

    $('.delete-form').on('submit', function(e) {
      e.preventDefault();
      var button = $(this);

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure you want to delete this record?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('stdpack/delete')}}",
            data: {
              '_method': 'delete'
            },
            success: function (response, textStatus, xhr) {
              Swal.fire({
                icon: 'success',
                  title: response,
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Yes'
              }).then((result) => {
                window.location='/stdpack'
              });
            }
          });
        }
      });
      
    })
  });
</script>
@endsection