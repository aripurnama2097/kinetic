@extends('layouts.mainPartlist')
 <head>
  
    
</head> 

@section('section')
{{-- <div class="page-wrapper"> --}}
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          {{-- <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
              Overview
            </div>
            <h2 class="page-title">
              Tentative SB98
            </h2>
          </div> --}}
        
        </div>
      </div>
    </div>




    <!-- Page body MENU -->
    {{-- <div class="page-body"> --}}
      
        {{-- <div class="container-xl mt-1 "> --}}
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 " >
            
                <div class="card-body border-bottom ">
          
                 <div class="table-responsive  rounded-1">
                  <div class="btn-group mb-5">               
                    <br>                  
                   
                  </div>
                  <h2 style="font-size:30px" class="text-dark text-center"> SB98 DATA </h2>
                  <a href="{{url('/schedule_tentative')}} " class="btn btn-primary" >Back </a>
                  <a href="{{url('/schedule_tentative/SB98')}} " class="btn btn-warning  float-right" >Refresh </a>
                  <br>
                  <br>
                  <br>
                  <div class="col-12">
                    <table  id="example" class="table table-bordered yajra-datatable" >
                      <thead class="thead-dark">
                        <tr>                   
                        
                          <th style ="font-size: 10px;">Customer Code</th>
                          <th style ="font-size: 10px;">Cust PO</th>
                          <th style ="font-size: 10px;">Part Number</th>
                          <th style ="font-size: 10px;">Part Name</th>                      
                          
                          <th style ="font-size: 10px;">Prod No</th>                       
                          <th style ="font-size: 10px;">Request Date</th>
                          <th style ="font-size: 10px;">JKEI Po Date</th>
                          <th style ="font-size: 10px;">Lot Qty</th>
                          <th style ="font-size: 10px;">Outset</th>
                          <th style ="font-size: 10px;">Van Date</th>
                          <th style ="font-size: 10px;">ETD</th>
                          <th style ="font-size: 10px;">ETA</th>
                         
                          
                        </tr>
                       </thead>
          
                      <tbody>
                       
                      </tbody>
                    </table>
                  </div>

             
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      

   
    {{-- </div> --}}
   


      {{-- ====================MODAL Master ========================================= --}}
<div class="modal modal-blur fade" id="modal-master" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Master File</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form  action="{{url('/schedule/upload')}}" enctype="multipart/form-data" method="POST" >
            @csrf  
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-10">
                  <div>
                    <label class="form-label">Schedule Excell</label>
                    <input  type="file" class="form-control" rows="3" name="sch"  id="sch" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-10">
                  <div>
                    <label class="form-label">SB98</label>
                    <input  type="file" class="form-control" rows="3" name="sb98"  id="sb98" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-10">
                  <div>
                    <label class="form-label">SA90</label>
                    <input  type="file" class="form-control" rows="3" name="sa90"  id="sa90" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-light " data-bs-dismiss="modal">
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

  
    //GENERATE SCHEDULE 
    $('#generate-sch').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure Generate schedule?',
          // input :text,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
        
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('schedule_tentative/generate')}}",    
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



    table = $('#datatable').DataTable( {
    paging: false
} );
 
      table.destroy();
      
      table = $('#datatable').DataTable( {
          searching: false
      } );





});


$(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/schedule_tentative/SB98') }}",
        columns: [
         
            {data: 'custcode', name: 'custcode'},
            {data: 'custpo', name: 'custpo'},
            {data: 'partnumber', name: 'partnumber'},
            {data: 'partname', name: 'partname'},
           
            {data: 'prodno', name: 'prodno'},
            {data: 'reqdate', name: 'reqdate'},
            {data: 'jkeipodate', name: 'jkeipodate'},
            {data: 'qty', name: 'qty'},
            {data: 'outset', name: 'outset'},
            {data: 'vandate', name: 'vandate'},
            {data: 'etd', name: 'etd'},
            {data: 'eta', name: 'eta'}
           

       
           
           
        ]
    });
    
  });



</script>




  @endsection