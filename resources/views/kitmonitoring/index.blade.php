@extends('layouts.main')

@section('section')
<style>
    .bg-header{
      background-color: rgb(21, 69, 95);;
    }
    
    .bg-header1{
     color: #068c9b;;
    }

    .bg-filter{
     color: #71c7d1;;
    }
    </style>
    <div class="page-wrapper"> 
        <div class="card mt-4 ">     
            <h1 style="font-weight:bold;font-size:30px" class="page-title text-primary ml-4 mt-3"> KIT MONITOR </h1> 
            {{-- <form class="mt-2  ml-3"action="{{url('kitmonitoring')}}" method="GET">			
                <div class="row">
                    <div class="col-lg-4">
                      <div class="card shadow-lg">
                          <div class="card-body bg-header">
                              <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">CUSTOMER CODE</h5>
                          </div>
                          <input type="text" id="custcode" name="custcode" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card shadow-lg">
                        <div class="card-body bg-header">
                            <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">PROD NUMBER</h5>
                        </div>
                        <input type="text" id="prodno" name="prodno" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                    </div>
                </div>
                
                  <div class="col-lg-4 ">
                    <div class="card shadow-lg">
                        <div class="card-body bg-header">
                            <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">VANDATE</h5>
                        </div>
                        <input type="text" id="vandate" name="vandate" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                    </div>
                </div>
    
                {{-- <div class="col-lg-3">
                  <div class="card shadow-lg ">
                      <div class="card-body bg-header ">
                          <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">PART NUMBER</h5>
                      </div>
                      <input type="text"  id="partno" name="partno" class="form-control form-control-sm" placeholder="please fill in"  autocomplete="off" autofocus>
                  </div>
                </div> --}}
  
            {{-- </div>  
            <div class="col-3 btn-group btn btn-sm mt-0 float-right mb-4">
              <button class="btn btn-info btn-sm " type="submit" ><i class="ti ti-search"></i> SEARCH</button>  --}}
              
            {{-- </div>
        </form>  --}}
        <div class="d-flex justify-content-end">

            <a class="btn btn-success  btn-sm mt-2 mb-2 col-1 mr-2" href="{{ url('/kitmonitoring') }}"> Refresh <i
                class="ti ti-refresh"></i> 
            </a>
        </div>
        </div>
        

        <div class="card mt-4 ">
                <div class="container-fluid mt-4">
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class="col-12 ">             
                        <div class="table-responsive  rounded-1 shadow-sm">
                            <table style="width:100%" id="kit-monitoring" class="table table-striped border border-primary shadow-sm">
                                <thead class="">
                                    <tr class="headings">      
                                        {{-- <th style="font-size: 10px;">No</th> --}}
                                        <th class="text-center" style="font-size: 13px;">Cust No</th>
                                        <th class="text-center" style="font-size: 13px;">Dest</th>
                                        <th class="text-center" style="font-size: 13px;">Model</th>
                                        <th class="text-center" style="font-size: 13px;">Prod No</th>
                                      
                                        <th class="text-center" style="font-size: 13px;">VanDate</th>
                                        <th class="text-center" style="font-size: 13px;">ETD</th>
                                        <th class="text-center" style="font-size: 13px;">ETA</th>
                                        <th class="text-center" style="font-size: 13px;">Shipvia</th>
                                        <th class="text-center" style="font-size: 13px;">Order Item</th>
                                        <th class="table-success" style="font-size: 13px;">MC Issue</th>
                                        <th class="text-center" style="font-size: 13px;">Diff MC</th>
                                        <th class="table-success" style="font-size: 13px;">Repacking In</th>
                                        <th class="text-center" style="font-size: 13px;">Diff Repacking</th>
                                        <th class="text-center" style="font-size: 13px;">FG Output</th>
                                        <th class="text-center" style="font-size: 13px;">Diff Finishgood </th>
                                        <th class="text-center" style="font-size: 13px;">Total Box</th>
                                        <th class="text-center" style="font-size: 13px;">Total Skid</th>
                                        <th class="text-center" style="font-size: 13px;">Part No</th>
                                        <th class="text-center" style="font-size: 13px;">Problem</th>
                                        <th class="text-center" style="font-size: 13px;">Status</th>
                                        <th class="text-center" style="font-size: 13px;">Invoice No</th>
                                        <th class="text-center" style="font-size: 13px;">Last Updated</th>
                                        <th class="text-center" style="font-size: 13px;">Response</th>                       
                                    </tr>
                                </thead>
                  
                                <tbody>
                                    @foreach ($data as $key => $value)      
                                    <tr>
                                        {{-- <td class="text-center">{{ ++$i}}</td> --}}
                                        <td class="text-center" style="font-size: 12px;">{{ $value->custcode }}</td>
                                        <td class="text-center" style="font-size: 12px;">{{ $value->dest }}</td>
                                        <td class="text-center" style="font-size: 12px;"> {{ $value->model }}</td>
                                        <td class="text-center" style="font-size: 12px;"> {{ $value->prodno }}</td>                                                                
                                        <td class="text-center" style="font-size: 12px;">{{ $value->vandate}} </td>
                                        <td class="text-center" style="font-size: 12px;">{{ $value->etd}}  </td>
                                        <td class="text-center" style="font-size: 12px;"> {{ $value->eta}} </td>
                                        <td class="text-center" style="font-size: 12px;"> {{ $value->shipvia}} </td>
                                        <td class="text-center text-dark" style="font-size: 13px;font-weight:bold">{{ $value->orderitem}}  </td>
                                        {{-- <td class="text-center" style="font-size: 13px;">today target </td> --}}
                                        <td class="text-center text-success" style="font-size: 13px;font-weight:bold" >{{ $value->mc_issue}} </td>
                                        <td class="text-center text-danger" style="font-size: 13px;font-weight:bold" >{{ $value->bal_mc}} </td>
                                        <td class="text-center text-success" style="font-size: 13px;font-weight:bold" >{{ $value->kit_output}}</td>
                                        <td class="text-center text-danger" style="font-size: 13px;font-weight:bold" > {{ $value->bal_kit}}</td>   
                                        <td class="text-center text-success" style="font-size: 13px;font-weight:bold" >{{ $value->fg_output}}</td>
                                        <td class="text-center text-danger" style="font-size: 13px;font-weight:bold" > {{ $value->bal_fg}}</td>                                                                        
                                        <td class="text-center" style="font-size: 13px;font-weight:bold"> {{ $value->total_box}}</td>
                                        <td class="text-center" style="font-size: 13px;font-weight:bold">{{ $value->total_skid}}</td>
                                        <td class="text-center" style="font-size: 12px;"> {{ $value->partno}}</td>                                       
                                        <td class="text-center" style="font-size: 12px;">{{$value->symptom}}</td>
                                        <td class="text-center" style="font-size: 12px;">                                              
                                            <?php if ($value->bal_mc != 0 && $value->symptom != NULL) {
                                                echo '<span class= "badge bg-danger">HOLD</span>';
                                              }
                                              if ($value->bal_mc == 0 && $value->symptom != NULL) {
                                                  echo '<span class= "badge bg-warning">RELEASE</span>';
                                              }
                
                                               if ($value->mc_issue != 0 && $value->bal_mc == 0 && $value->symptom == NULL) {
                                                echo '<span class= "badge bg-success">READY</span>';
                                              }
                
                                                    
                                              ?> 
                                        
                                        </td>
                                        <td class="text-center text-primary" style="font-size: 13px;font-weight:bold">{{$value->invoice_no}} </td>                                          
                                        <td class="text-dark text-center"   style="font-size: 13px; font-weight:bold"> </td>
                                        <td  style="font-size: 14px;" disabled>       
                                            {{-- updateModal_{{$value->id}}
    
                                        --}}<div class="dialog-pro dialog">
                                            <?php if ($value->bal_mc ==0 && $value->bal_kit == 0 ){?>
                                                <a  class="btn btn-primary btn-sm text-white"  data-toggle="modal" data-target="#updateModal_{{$value->prodno}}"><i class="ti ti-rotate-rectangle"></i>Update Invoice</a>
                                            <?php }?>
                                        </div>
                                      
                                        <div class="modal modal-blur fade" id="updateModal_{{$value->prodno}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title">Update Invoice</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>                                            
                                                    <div class="modal-body">
                                                        {{-- action="{{ url('problem/update/' . $value->id) }}" --}}
                                                      <form action="{{ url('kitmonitoring/update/' . $value->prodno) }} "  method="POST" >
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Input NIK</label>
                                                            <input type="text" id="pic" name="pic" class="form-control" placeholder="INPUT NIK">
                                                        </div>    
                                                        <div class="mb-3">
                                                            <label class="form-label">Invoice No</label>
                                                            <input type="text" id="invoice" name="invoice" class="form-control" placeholder="INVOICE">
                                                        </div>                                               
                                                    </div>  
                                                </div>
                                          
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link link-warning" data-bs-dismiss="modal">
                                                            Cancel
                                                          </button>
                                                      <button type="submit" id="update" class="btn btn-primary ms-auto" >
                                                        Submit
                                                      </button>
                                                   </div>
                                                </form>
                                            </div>
                                        </div>                                     
                                        </td> 
                                    </tr>       
                                    @endforeach
                                </tbody>
                            </table>
                           
                        </div>  
                        <div class="d-flex justify-content-center col-12 btn-sm">
                            {{-- {{ $data->links('vendor.pagination.custom') }} --}}
          
                          </div>                       
                    </div>
               </div>
        </div>
                
    </div>
           

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">
    
        $(document).ready(function() {
            $('#kit-monitoring').DataTable( {
                dom: 'Bfrtip',
                // order: [6,'desc'], 
                buttons: [
                
                    'excelHtml5',
                    'csvHtml5'
                ],
                // paging:false,
             
            } );
        });
    </script>
@endsection
