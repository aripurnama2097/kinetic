@extends('layouts.main')

@section('section')
 
{{-- <style>
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
            /* color: white; */
            background: rgb(255, 174, 0);
            
        
        }
}
</style> --}}
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
                  <div style="font-size:15px" class="subheader text-dark">Problem Found</div>
                  <div class="ms-auto lh-1">
                              
                  </div>
                </div>
                <div class="h1 mb-3"></div>
                <div class="d-flex mb-2">
                  <div class="align-content-around text-primary">
                    <p class="text-center text-danger" style="font-weight:bold;font-size:20px">{{$problem}} </p>
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
            <div class="card blink">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div style="font-size:15px" class="subheader text-dark">Borrow Data</div>
                  <div class="ms-auto lh-1">
                              
                  </div>
                </div>
                <div class="h1 mb-3"></div>
                <div class="d-flex mb-2">
                  <div class="align-content-around text-primary">
                    <p class="text-center text-dark align-center" style="font-weight:bold;font-size:20px">{{$borrow}} </p>
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
                  <div style="font-size:15px" class="subheader text-dark">History Problem</div>
                  <div class="ms-auto lh-1">                 
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <div class="h1 mb-3 me-2"></div>
                  <div class="me-auto">
                    <span class="text-yellow d-inline-flex align-items-center lh-1">
                   
                    </span>
                  </div>
                </div>
                <div id="chart-new-clients" class="chart-sm"></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-light">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div style="font-size:15px" class="subheader text-dark">Active User</div>
                  <div class="ms-auto lh-1">
                   
                  </div>
                </div>
                <div class="d-flex align-items-baseline">
                  <div class="h1 mb-3 me-2"></div>
                  <div class="me-auto">
                    
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
                  
                </div>
              </div>
            </div>
          </div>
  
        </div>

        <div class="card bg-light">
  
          <div class="table-responsive  rounded-1 shadow-sm mt-3">
            <table style="width:100%" id="kit-monitor"  class="table table-vcenter table-striped">
                <thead >
                    <tr class="headings">                   
                        <th style="font-size: 10px;">Customer Code</th>
                        {{-- <th style="font-size: 10px;">Qty Receive</th> --}}
                        <th style="font-size: 10px;">Dest</th>
                        <th style="font-size: 10px;">Attent</th>
                        <th style="font-size: 10px;">Model</th>
                        <th style="font-size: 10px;">Prod No</th>
                        <th style="font-size: 10px;">Lot Qty</th>
                        <th style="font-size: 10px;">shpvia</th>
                        <th style="font-size: 10px;">JKEI-Po</th>
                        <th style="font-size: 10px;">VanDate</th>
                        {{-- <th style="font-size: 10px;">ETD</th>
                        <th style="font-size: 10px;">ETA</th>
                        <th style="font-size: 10px;">Ship Via</th> --}}
                        <th style="font-size: 10px;">Order-Item</th>
                        <th style="font-size: 10px;">Cust PO</th>
                        <th style="font-size: 10px;">Part Number</th>
                        <th style="font-size: 10px;">Part Name</th>
                        <th style="font-size: 10px;">JKN Shelf No</th>
                        <th style="font-size: 10px;">Demand</th>
                        <th style="font-size: 10px;">Actual Receive</th>
                        <th style="font-size: 10px;">Balance Receive</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $key => $value)
                     
                    <td style="font-size: 12px;"> {{ $value->custcode }}</td>
                
                    <td style="font-size: 12px;"> {{ $value->dest }}</td>
                    <td style="font-size: 12px;"> </td>
                        <td style="font-size: 12px;"> {{ $value->model }}</td>
                        <td style="font-size: 12px;"> {{ $value->prodno }}</td>
                        <td style="font-size: 12px;"> </td>
                        <td style="font-size: 12px;"> </td>
                        <td style="font-size: 12px;">
                            {{$value->jkeipodate}}
                        </td>
                        <td style="font-size: 12px;"> {{ $value->vandate }}</td>
                       
                        <td style="font-size: 12px;"> {{ $value->orderitem }}</td>
                        <td style="font-size: 12px;">{{ $value->custpo }} </td>
                        <td style="font-size: 12px;">{{ $value->partno }} </td>
                        <td style="font-size: 12px;">{{ $value->partname }} </td>
                        <td style="font-size: 12px;"> </td>
                        <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                        <td class="text-primary text-center"   style="font-size: 14px; font-weight:bold"> {{ $value->act_receive }}</td>
                        <td class="text-danger text-center" style="font-size: 14px;">{{ $value->bal_receive }} </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
<script type="text/javascript">   
    $(document).ready(function() {
        $('#kit-monitor').DataTable( {
            // dom: 'Bfrtip',
            // buttons: [
            
            //     'excelHtml5',
            //     'csvHtml5'
            // ]
        } );
      });
</script>
@endsection