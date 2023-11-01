@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        {{-- <div class="page-header d-print-none">
          <div class="container-xl ml-2">
            
          </div>
        </div> --}}
{{-- 
        Overview
              <h2 class="page-title text-light"> KIT MONITOR </h2> --}}
        <div class="card mt-4 shadow">
            <h1 class="page-title text-primary ml-5"> KIT MONITOR </h1> 
                <div class="container-fluid mt-4">
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class="col-12 ">             
                        <div class="table-responsive  rounded-1 shadow-sm">
                            <table style="width:100%" id="kit-monitor" class="table table-vcenter table-striped">
                                <thead class="thead-dark">
                                    <tr class="headings">      
                                      
                                        <th class="text-center" style="font-size: 13px;">Cust No</th>
                                        <th class="text-center" style="font-size: 13px;">Dest</th>
                                        <th class="text-center" style="font-size: 13px;">Model</th>
                                        <th class="text-center" style="font-size: 13px;">Prod No</th>
                                        {{-- <th class="text-center" style="font-size: 13px;">Lot Qty</th> --}}
                                        {{-- <th class="text-center" style="font-size: 13px;">JKEI Po Date</th> --}}
                                        <th class="text-center" style="font-size: 13px;">VanDate</th>
                                        <th class="text-center" style="font-size: 13px;">ETD</th>
                                        <th class="text-center" style="font-size: 13px;">ETA</th>
                                        <th class="text-center" style="font-size: 13px;">Shipvia</th>
                                        <th class="text-center" style="font-size: 13px;">Order Item</th>
                                        {{-- <th class="text-center" style="font-size: 13px;">Today target</th> --}}
                                        <th class="table-success" style="font-size: 13px;">MC Issue</th>
                                        <th class="text-center" style="font-size: 13px;">Diff MC</th>
                                        <th class="text-center" style="font-size: 13px;">In House</th>
                                        <th class="text-center" style="font-size: 13px;">Bal Inhouse</th>
                                        <th class="text-center" style="font-size: 13px;">KIT Output</th>
                                        <th class="text-center" style="font-size: 13px;">Balance</th>
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
                                   
                                    <td class="text-center" style="font-size: 12px;">{{ $value->custcode }}</td>
                                    <td class="text-center" style="font-size: 12px;">{{ $value->dest }}</td>
                                    <td class="text-center" style="font-size: 12px;"> {{ $value->model }}</td>
                                    <td class="text-center" style="font-size: 12px;"> {{ $value->prodno }}</td>                                         
                                    {{-- <td class="text-center text-dark" style="font-size: 13px;font-weight:bold">{{ $value->lot_qty}}</td>              --}}
                                    {{-- <td class="text-center" style="font-size: 12px;">{{ $value->jkeipodate }} </td> --}}
                                    <td class="text-center" style="font-size: 12px;">{{ $value->vandate}} </td>
                                    <td class="text-center" style="font-size: 12px;">{{ $value->etd}}  </td>
                                    <td class="text-center" style="font-size: 12px;"> {{ $value->eta}} </td>
                                    <td class="text-center" style="font-size: 12px;"> {{ $value->shipvia}} </td>
                                    <td class="text-center text-dark" style="font-size: 13px;font-weight:bold">{{ $value->orderitem}}  </td>
                                    {{-- <td class="text-center" style="font-size: 13px;">today target </td> --}}
                                    <td class="text-center text-success" style="font-size: 13px;font-weight:bold" >{{ $value->mc_issue}} </td>
                                    <td class="text-center text-danger" style="font-size: 13px;font-weight:bold" >{{ $value->bal_mc}} </td>
                                    <td class="text-center text-success" style="font-size: 13px;font-weight:bold" >{{ $value->inhouse_output}} </td>
                                    <td class="text-center text-danger" style="font-size: 13px;font-weight:bold" >{{ $value->bal_inhouse}} </td>
                                    <td class="text-center text-success" style="font-size: 13px;font-weight:bold" >{{ $value->kit_output}}</td>
                                    <td class="text-center text-danger" style="font-size: 13px;font-weight:bold" > {{ $value->bal_kit}}</td>                                  
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
                    </div>
               </div>
        </div>         
    </div>
           

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">
    
        $(document).ready(function() {
            $('#kit-monitor').DataTable( {
                dom: 'Bfrtip',
                order: [6,'desc'], 
                buttons: [
                
                    'excelHtml5',
                    'csvHtml5'
                ]
            } );
        });
    </script>
@endsection
