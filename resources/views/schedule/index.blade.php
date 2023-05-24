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
              Schedule
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
                <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modal-scheduleTemp"> <i class="ti ti-arrow-big-down-filled"></i>
                  Upload Schedule Temp
                </a>
                <a href="#" class="btn btn-light btn-sm " data-bs-toggle="modal" data-bs-target="#modal-sb98"> <i class="ti ti-arrow-big-down-filled"></i>
                  Upload SB98
                </a>
                <a href="#" class="btn btn-light btn-sm " data-bs-toggle="modal" data-bs-target="#modal-sa90"><i class="ti ti-arrow-big-down-filled"></i>
                  Upload SA90
                </a>
              </span>
                {{-- <br> --}}
                <button id="confirm-sb98" class="btn btn-secondary d-none d-sm-inline-block btn-sm  float-right" >
                  <i class="ti ti-merge"></i>
                  Summary SB98
                </button>
                
              
               
             
              <button  id="generate-sch" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-schedule">
                {{-- <i class="ti ti-plus"></i> --}}
                Generate Schedule
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Page body MENU -->
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
          
          <div class="col-12">
            <div class="card rounded-1">
              <div class="card-header">
                <h2>FILTER </h2>
      
              </div>

              @if(Session::has('success'))
              <p class="alert alert-success">{{Session::get('success')}}</p>
              @endif

              @if(Session::has('oke'))
              <p class="alert alert-success">{{Session::get('oke')}}</p>
              @endif

              <div class="input-group col-3">
                <select class="form-control" id="filter" name = "prodno">
                  <option value="-">-- RELEASE DATE --</option>
                  @foreach($data as $dd)
                  <option value="{{$dd->prodno}}">{{$dd->prodno}}</option>
                  @endforeach            
                      <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                </select>          
           

            
                <select class="form-control" id="filter" name = "prodno">
                  <option value="-">-- PROD NO --</option>
                  @foreach($data as $dd)
                  <option value="{{$dd->prodno}}">{{$dd->prodno}}</option>
                  @endforeach            
                      <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                </select>          
              </div>

              <div class="card-body border-bottom ">
                <button id="share-schedule" class="btn btn-success d-none d-sm-inline-block btn-sm" >
                  <i class="ti ti-share"></i>
                 Share Schedule
                </button>

                <a href="#" class="btn btn-primary d-none d-sm-inline-block  btn-sm" >
                  <i class="ti ti-file-export"></i>
                 Generate Partlist
                </a>
                <a href="{{url('/schedule')}}" class="btn btn-warning d-none d-sm-inline-block float-right btn-xs" >
                  <i class="ti ti-360"></i>
                  Refresh
                </a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
               


      {{-- <div class="page-body"> --}}
        <div class="container-xl mt-1 ">
          <div class="row row-deck row-cards ">
            
            <div class="col-12">
              <div class="card rounded-1 " >
                <div class="card-header">
      
                </div>
                <div class="card-body border-bottom ">

                 <div class="table-responsive  rounded-1 ">
                   {{-- <table id="example" class="table card-table table-vcenter text-nowrap datatable"> --}}
                    <table id="example" class="table  text-nowrap datatable table table-striped" >
                     <thead class="thead-dark">
                       <tr>
                         {{-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                         <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                         </th> --}}
                         <th>No</th>
                         <th>Customer Code</th>
                         <th>Destination</th>
                         <th>Attention</th>
                         <th>Model</th>
                         <th>Prod No</th>
                         <th>Lot Qty</th>
                         <th>JKEI Po Date</th>
                         <th>Van Date</th>
                         <th>ETD</th>
                         <th>ETA</th>
                         <th>Ship Via</th>
                         <th>Order Item</th>
                         <th>Cust PO</th>
                         <th>Part Number</th>
                         <th>Part Name</th>
                         <th>Cust Shelf Number</th>
                         <th>Demand</th>
                         
                       
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($data as $key => $value)
                       <tr>
                         <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                         <td> {{$value->custcode}}</td>
                         <td > {{$value->dest}}</td>
                         <td> {{$value->attention}}</td>
                         <td> {{$value->model}}</td>
                         <td> {{$value->prodno}}</td>
                         <td> {{$value->lotqty}}</td>
                         <td> {{$value->jkeipodate}}</td>
                         <td> {{$value->vandate}}</td>
                         <td> {{$value->etd}}</td>
                         <td> {{$value->eta}}</td>
                         <td> {{$value->shipvia}}</td>
                         <td> {{$value->orderitem}}</td>
                         <td>{{$value->custpo}} </td>
                         <td>{{$value->partno}} </td>
                         <td>{{$value->partname}} </td>
                         <td> </td>
                         <td> {{$value->demand}}</td>                
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      {{-- </div> --}}
               

             
            
              
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


  {{-- ====================MODAL Schedule Temp ========================================= --}}
<div class="modal modal-blur fade" id="modal-scheduleTemp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Schedule Temp</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form  action="{{url('/schedule/upload')}}" enctype="multipart/form-data" method="POST" >
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
              <a href="#" class="btn btn-link link-warning" data-bs-dismiss="modal">
                Cancel
              </a>
              <button type="submit" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                <i class="ti ti-plus"></i>
                Upload 
              </button>
            </div>
          </form>
        </div>
    </div>
</div>

{{-- ====================MODAL SB98 ========================================= --}}
<div class="modal modal-blur fade" id="modal-sb98" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Upload - SB98</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form  action="{{url('/schedule/uploadSB98')}}" enctype="multipart/form-data" method="POST" >
            @csrf  
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Upload file</label>
                    <input  type="file" class="form-control" rows="3" name="file" required id="file">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-link link-warning" data-bs-dismiss="modal">
                Cancel
              </a>
              <button type="submit" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                <i class="ti ti-plus"></i>
                Upload 
              </button>
            </div>
          </form>
        </div>
    </div>
</div>





{{-- ====================MODAL SA90 ========================================= --}}

<div class="modal modal-blur fade" id="modal-sa90" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">SA90 Upload</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
         
          <form  action="{{url('/schedule/uploadsa90')}}" enctype="multipart/form-data" method="POST" >
            @csrf
           
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Upload file</label>
                    <input  type="file" class="form-control" rows="3" name="file" required id="file">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-link link-warning" data-bs-dismiss="modal">
                Cancel
              </a>
              <button type="submit" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <i class="ti ti-plus"></i>
                Upload 
              </button>
              
            </div>
          </form>
        </div>
  </div>
</div>

</a>
</div>

<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript">

$(document).ready(function () {
    // $('#example').DataTable();
    
    // CONFIRM SUMMARY SB98
    $('#confirm-sb98').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure summary SB98?',
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
            url: "{{url('/schedule/sumsb98')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Summary Finish.',
                  'success'
                    )
              }
          });
        }
      });
    });

    //SHARE SCHEDULE DIC
    $('#share-schedule').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: ' Share Update Schedule?',
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
            url: "{{url('/schedule/email')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Share Schedule to DIC',
                  'success'
                    )
              }
          });
        }
      });
    });

    //GENERATE SCHEDULE 
    $('#generate-sch').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure Generate schedule?',
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
            url: "{{url('schedule/generate')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Update Schedule',
                  'success'
                    )
              }
          });
        }
      });
    });


    // $('#example').dataTable({
    // processing: true,
    // serverSide: true,
    // ajax: '',
    // columns: [
    //     {data: 'custcode', name: 'custcode'},
    //     {data: 'name', name: 'name'},
    //     {data: 'email', name: 'email'},
    //     {data: 'created_at', name: 'created_at'},
    //     {data: 'updated_at', name: 'updated_at'}
    // ],
    //   search: {
    //     "regex": true
    //   }


    
});

</script>




  @endsection