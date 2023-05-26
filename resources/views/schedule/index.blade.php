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
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Page body MENU -->
    <div class="page-body">
      <div class="container-xl">
        {{-- <div class="row row-deck row-cards">
        
        </div> --}}
      </div>
    
        <div class="container-xl mt-1 ">
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 " >
                <div class="card-header text-center justify-content-center">
                  <h2 style="font-size:30px"class="text-primary " >--RELEASE SCHEDULE--</h2> 
                </div>
                <div class="col-12 border-bottom bt-2  ">
              
                  <button id="share-schedule" class="btn btn-info d-none d-sm-inline-block btn-sm" >
                    <i class="ti ti-share"></i>
                   Share Schedule
                  </button>
  
                  <a href="#" class="btn btn-secondary d-none d-sm-inline-block  btn-sm" >
                    <i class="ti ti-file-export"></i>
                   Generate Partlist
                  </a>

                  <ul class="dropdown-menu ">
                    {{-- <li><a class="dropdown-item" href="{{url('schedule_tentative/serviceOK')}}">Schedule Tentative</a></li>  --}}
                    <li><a class="dropdown-item" href="">Service Part</a></li> 
                
                  </ul>

                 
                  <a href="{{url('/schedule')}}" class="btn btn-warning d-none d-sm-inline-block btn-sm" >
                    <i class="ti ti-360"></i>
                    Refresh
                  </a>
                  <br>
                  <br>

                  <div>
                    <select style="font-size:15px" class="form-control col-2 btn btn-secondary btn-sm" id="filter" name = "prodno">
                      <option value="-">-- FILTER --</option>
                      @foreach($data2 as $dd)
                      <option value="{{$dd->prodno}}">{{$dd->prodno}}</option>
                      @endforeach            
                          <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                    </select>  
                  </div>
                </div>
               
 
                <div class="card-body border-bottom ">            
                  <div class="table-responsive  rounded-1 shadow-sm">                  
                   <table style="width:100%" id="example" class="text-nowrap  table table-bordered border border-primary shadow-sm" >
                     <thead class="thead-dark">
                       <tr>                   
                         <th style ="font-size: 10px;">Schedule Number</th>   
                         <th style ="font-size: 10px;">Customer Code</th>
                         <th style ="font-size: 10px;">Destination</th>
                         <th style ="font-size: 10px;">Attention</th>
                         <th style ="font-size: 10px;">Model</th>
                         <th style ="font-size: 10px;">Prod No</th>
                         <th style ="font-size: 10px;">Lot Qty</th>
                         <th style ="font-size: 10px;">shpvia</th>
                         {{-- <th style ="font-size: 10px;">JKEI Po Date</th>
                         <th style ="font-size: 10px;">Van Date</th>
                         <th style ="font-size: 10px;">ETD</th>
                         <th style ="font-size: 10px;">ETA</th> --}}
                         <th style ="font-size: 10px;">Ship Via</th>
                         <th style ="font-size: 10px;">Order Item</th>
                         <th style ="font-size: 10px;">Cust PO</th>
                         <th style ="font-size: 10px;">Part Number</th>
                         <th style ="font-size: 10px;">Part Name</th>                       
                         <th style ="font-size: 10px;">Demand</th>                    
                       </tr>
                      </thead>
         
                     <tbody>
                       @foreach($data as $key => $value)
                  
                        </td>
                         <td style ="font-size: 12px;"> {{$value->schcode}}</td>
                         <td style ="font-size: 12px;"> {{$value->custcode}}</td>
                         <td style ="font-size: 12px;"> {{$value->dest}}</td>
                         <td style ="font-size: 12px;"> {{$value->attention}}</td>
                         <td style ="font-size: 12px;"> {{$value->model}}</td>
                         <td style ="font-size: 12px;"> {{$value->prodno}}</td>
                         <td style ="font-size: 12px;"> {{$value->lotqty}}</td>
                         <td style ="font-size: 12px;"> {{$value->shipvia}}</td>
                         {{-- <td style ="font-size: 12px;"> {{$value->jkeipodate}}</td> 
                         <td style ="font-size: 12px;"> {{$value->vandate}}</td>
                         <td style ="font-size: 12px;"> {{$value->etd}}</td>
                         <td style ="font-size: 12px;"> {{$value->eta}}</td> --}}
                         <td style ="font-size: 12px;"> {{$value->shipvia}}</td>
                         <td style ="font-size: 12px;"> {{$value->orderitem}}</td>
                         <td style ="font-size: 12px;">{{$value->custpo}} </td>
                         <td style ="font-size: 12px;">{{$value->partno}} </td>
                         <td style ="font-size: 12px;">{{$value->partname}} </td> 
                         <td style ="font-size: 12px;"> {{$value->demand}}</td>                  -
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



    table = $('#datatable').DataTable( {
    paging: false
} );
 
      





});



</script>




  @endsection