@extends('layouts.main')
 <head>
  
    
</head> 

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
              Tentative Schedule 
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
        
              </span>
                {{-- <br> --}}
            </div>
          </div>
        </div>
      </div>
    </div>




    <!-- Page body MENU -->
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
       
        </div>
      </div>
               
        <div class="container-xl mt-1 ">
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 " >
                {{-- <div class="card-header text-center justify-content-left">
                  <h2 style="font-size:25px;" class="btn btn-dark text-light  " >TENTATIVE SCHEDULE</h2> 
                </div> --}}
                <div class="col-12 border-bottom bt-2  ">
                </div>

                <div class="card-body border-bottom ">
                
                 <div class="table-responsive  rounded-1">
                  <div class="btn-group mb-2">
                  
                    <a href="{{url('/schedule_tentative')}} " class="btn btn-secondary float-right" >Back</a>
                    <br>
                   
                    <ul class="dropdown-menu ">
                     
                  </div>
                  <h2 class="text-primary text-center"> SKD Part</h2>
                  <div class="col-12">
                    <table style="width:100%" id="example" class="text-nowrap  table border border-secondary" >
                      <thead class="thead-dark">
                        <tr>                   
                          <th style ="font-size: 10px;">Result</th>  
                          <th class="table-warning ">Modelname SA90</th>  
                          <th class="table-success">ProdNo SA90</th>  
                          <th class="table-success">Part number SA90</th>  
                          <th class="table-success">Demand SA90</th>  

                          
                         
                          <th style ="font-size: 10px;">Model</th>
                          <th style ="font-size: 10px;">Prod No</th>
                          <th class="table-success">Part Number</th>                       
                          <th style ="font-size: 10px;">Demand</th>             
                        </tr>
                       </thead>
          
                      <tbody>
                        @foreach($data as $key => $value)
                        <tr class="border border-dark">
                         <td style ="font-size: 12px;"> <?php 
                         if($value->partnumber == NULL){
                           echo '<span class= "badge text-bg-danger">Part Number Tidak Ditemukan</span>';
                         }
                         
                         else{
                     
                         echo '<span class= "badge text-bg-success">OK</span>';
                         }?>
                         </td>
                          {{-- <td style ="font-size: 12px;"> tes</td> --}}
                     
                          <td  style ="font-size: 12px;">{{$value->modelname}}  </td>                
                          <td  style ="font-size: 12px;">{{$value->prodNo}} </td>
                          <td  style ="font-size: 12px;">{{$value->partnumber}}  </td>                
                          <td  style ="font-size: 12px;">{{$value->qty}} </td>

                         
                          <td style ="font-size: 12px;">   {{$value->model}} </td>
                          <td style ="font-size: 12px;"  data-order="1" data-filter="prodno">
                            {{$value->prodno}} 
                            </td>
                          <td style ="font-size: 12px;">  {{$value->partno}} 
                           
                             </td>
                          <td style ="font-size: 12px;"> {{$value->demand}} 
                           
                            </td>                                   
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                   {{-- <table style="width:100%" id="datatable" class="text-nowrap  table table-bordered border border-primary shadow-sm" >
                    <thead class="thead-dark">
                      <tr>                   
                        <th style ="font-size: 10px;">Result</th>   
                        <th style ="font-size: 10px;">Customer Code</th>
                        <th style ="font-size: 10px;">Destination</th>
                        <th style ="font-size: 10px;">Attention</th>
                        <th style ="font-size: 10px;">Model</th>
                        <th style ="font-size: 10px;">Prod No</th>
                       
                        <th style ="font-size: 10px;">Lot Qty</th>
                        <th style ="font-size: 10px;">JKEI Po Date</th>
                        <th style ="font-size: 10px;">Van Date</th>
                        <th style ="font-size: 10px;">ETD</th>
                        <th style ="font-size: 10px;">ETA</th>
                        <th style ="font-size: 10px;">Ship Via</th>
                        <th style ="font-size: 10px;">Order Item</th>
                        <th style ="font-size: 10px;">Cust PO</th>
                        <th style ="font-size: 10px;">Part Number</th>
                        <th style ="font-size: 10px;">Part Name</th>                      
                        <th>Demand</th>                    
                      </tr>
                     </thead>
        
                    <tbody>
                      @foreach($skdall as $key => $value)
                      <tr class="border border-dark">
                       <td style ="font-size: 12px;"> <?php 
                       if($value->partno == NULL){
                         echo '<span class= "badge text-bg-danger">Failed</span>';
                       }
                       
                       else{
                   
                       echo '<span class= "badge text-bg-success">Success</span>';
                       }?>
                       </td>
                        <td style ="font-size: 12px;"> {{$value->custcode}}</td>
                        <td style ="font-size: 12px;"> {{$value->dest}}</td>
                        <td style ="font-size: 12px;"> {{$value->attention}}</td>
                        <td style ="font-size: 12px;"> {{$value->model}}</td>
                        <td style ="font-size: 12px;"  data-order="1" data-filter="prodno"> {{$value->prodno}}</td>
                        <td style ="font-size: 12px;"> {{$value->lotqty}}</td>
                        <td style ="font-size: 12px;"> {{$value->jkeipodate}}</td>
                        <td style ="font-size: 12px;"> {{$value->vandate}}</td>
                        <td style ="font-size: 12px;"> {{$value->etd}}</td>
                        <td style ="font-size: 12px;"> {{$value->eta}}</td>
                        <td style ="font-size: 12px;"> {{$value->shipvia}}</td>
                        <td style ="font-size: 12px;"> {{$value->orderitem}}</td>
                        <td style ="font-size: 12px;">{{$value->custpo}} </td>
                        <td style ="font-size: 12px;">{{$value->partno}} </td>
                        <td style ="font-size: 12px;">{{$value->partname}} </td>                   
                        <td style ="font-size: 12px;"> {{$value->demand}}</td>                
                      </tr>
                      @endforeach
                    </tbody>
              
                  </table> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                
        {{-- <div class="container-xl mt-0 ">
          <div class="row row-deck row-cards ">           
            <div class="col-12">
              <div class="card rounded-1 " >
                <div class="card-header text-center">
                  <h2 class="btn btn-success" >SKD PART</h2> 
                </div>
                <div class="card-body border-bottom ">
                 <div class="table-responsive  rounded-1 shadow-sm">
                   <table style="width:100%" id="datatable" class="table  text-nowrap datatable table table-striped" >
                    <thead class="thead-dark">
                      <tr>                      
                        <th style ="font-size: 10px;">Customer Code</th>
                        <th style ="font-size: 10px;">Destination</th>
                        <th style ="font-size: 10px;">Attention</th>
                        <th style ="font-size: 10px;">Model</th>
                        <th style ="font-size: 10px;">Prod No</th>
                        <th style ="font-size: 10px;">Lot Qty</th>
                        <th style ="font-size: 10px;">JKEI Po Date</th>
                        <th style ="font-size: 10px;">Van Date</th>
                        <th style ="font-size: 10px;">ETD</th>
                        <th style ="font-size: 10px;">ETA</th>
                        <th style ="font-size: 10px;">Ship Via</th>
                        <th style ="font-size: 10px;">Order Item</th>
                        <th style ="font-size: 10px;">Cust PO</th>
                        <th style ="font-size: 10px;">Part Number</th>
                        <th style ="font-size: 10px;">Part Name</th>                      
                        <th>Demand</th>                    
                      </tr>
                     </thead>
                     <tbody>
                      @foreach($data2 as $key => $value)
                      <tr>
                       
                        <td style ="font-size: 12px;"> {{$value->custcode}}</td>
                        <td style ="font-size: 12px;"> {{$value->dest}}</td>
                        <td style ="font-size: 12px;"> {{$value->attention}}</td>
                        <td style ="font-size: 12px;"> {{$value->model}}</td>
                        <td style ="font-size: 12px;"  data-order="1" data-filter="prodno"> {{$value->prodno}}</td>
                        <td style ="font-size: 12px;"> {{$value->lotqty}}</td>
                        <td style ="font-size: 12px;"> {{$value->jkeipodate}}</td>
                        <td style ="font-size: 12px;"> {{$value->vandate}}</td>
                        <td style ="font-size: 12px;"> {{$value->etd}}</td>
                        <td style ="font-size: 12px;"> {{$value->eta}}</td>
                        <td style ="font-size: 12px;"> {{$value->shipvia}}</td>
                        <td style ="font-size: 12px;"> {{$value->orderitem}}</td>
                        <td style ="font-size: 12px;">{{$value->custpo}} </td>
                        <td style ="font-size: 12px;">{{$value->partno}} </td>
                        <td style ="font-size: 12px;">{{$value->partname}} </td>
                     
                        <td style ="font-size: 12px;"> {{$value->demand}}</td>                
                      </tr>
                      @endforeach
                    </tbody>
              
                  </table>
                  
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      {{-- </div> --}}
               

   
    </div>
   


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
                    <input  type="file" class="form-control" rows="3" name="excell"  id="excell" required>
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


// const filterDropdown = document.getElementById("filter");
// const itemList = document.getElementById("example");
// var rows = table.getElementsByTagName("tr");

// filterDropdown.addEventListener("change", function() {
//   const selectedValue = filterDropdown.value;

//   for (let i = 0; i < items.length; i++) {
//     const item = items[i];

//     if (selectedValue === "all" || item.classList.contains(selectedValue)) {
//       item.classList.add("show");
//     } else {
//       item.classList.remove("show");
//     }
//   }
// });


});



</script>




  @endsection