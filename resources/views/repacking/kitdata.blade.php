@extends('layouts.main')

@section('section')
<style>
.bg-header{
  background-color: rgb(44, 138, 188);;
}

.bg-header1{
 color: #068c9b;;
}
</style>
    <div class="page-wrapper">
        <!-- Page body MENU -->
        <div class="bg-light mt-3">
            <div class="container-fluid mt-1">
              
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif


                    <div class="col-12 ">
                        <div class="card  col-12 ">
                            <h2 style="font-weight:bold" class="page-title text-dark ml-4 mt-3">REPACKING - SCANIN</h2>
                            <div class="card-body border-bottom ">
                                <form class="mt-2 mb-2"action="{{url('repacking/kitdata')}}" method="GET">			
                                    <div class="row">
                                        <div class="col-lg-3">
                                          <div class="card shadow-lg">
                                              <div class="card-body bg-header">
                                                  <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">CUSTOMER CODE</h5>
                                              </div>
                                              <input type="text" id="custcode" name="custcode" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                                          </div>
                                      </div>
                                      <div class="col-lg-3">
                                        <div class="card shadow-lg">
                                            <div class="card-body bg-header">
                                                <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">PROD NUMBER</h5>
                                            </div>
                                            <input type="text" id="prodno" name="prodno" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                                        </div>
                                    </div>
                                    
                                      <div class="col-lg-3 ">
                                        <div class="card shadow-lg">
                                            <div class="card-body bg-header">
                                                <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">CUSTPO</h5>
                                            </div>
                                            <input type="text" id="custpo" name="custpo" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                                        </div>
                                    </div>
                        
                                    <div class="col-lg-3">
                                      <div class="card shadow-lg ">
                                          <div class="card-body bg-header ">
                                              <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">PART NUMBER</h5>
                                          </div>
                                          <input type="text"  id="partno" name="partno" class="form-control form-control-sm" placeholder="please fill in"  autocomplete="off" autofocus>
                                      </div>
                                    </div>
                      
                                </div>  
                                <div class="col-3 btn-group btn btn-sm mt-0 float-right mb-4">
                                  <button class="btn btn-info btn-sm " type="submit" ><i class="ti ti-search"></i> SEARCH</button> 
                                  <a class="btn btn-success btn-sm" href="{{ url('/repacking/kitdata') }}"> Refresh <i
                                    class="ti ti-refresh"></i> </a>
                                </div>
                            </form>
                            <button class="btn btn-dark btn-sm " onclick="download()"><i class="ti ti-download"></i> Download</button>
                             
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    <table style="width:100%"  class="table table-striped border border-primary shadow-sm">
                                       
                                        <thead class="thead-dark">
                                            <tr class="headings">
                                                <th style="font-size: 10px;">No</th>
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
                                                {{-- <th class="text-center"colspan ="3" style="font-size: 10px;">Detail Receive</th> --}}

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $key => $value)
                                            <td class="text-center">{{ ++$i}}</td>
                                            <td style="font-size: 12px;"> {{ $value->custcode }}</td>
                                            {{-- <td class="text-dark text-center" style="font-size: 14px; font-weight:bold">{{ $value->qty_receive }} </td> --}}
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
                                                {{-- <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;"></td> --}}
                                                <td style="font-size: 12px;"> {{ $value->orderitem }}</td>
                                                <td style="font-size: 12px;">{{ $value->custpo }} </td>
                                                <td style="font-size: 12px;">{{ $value->partno }} </td>
                                                <td style="font-size: 12px;">{{ $value->partname }} </td>
                                                <td style="font-size: 12px;"> </td>
                                                <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                                                <td class="text-primary text-center"   style="font-size: 14px; font-weight:bold"> {{ $value->act_receive }}</td>
                                                <td class="text-danger text-center" style="font-size: 14px;">{{ $value->bal_receive }} </td> 
                                                {{-- <td class="text-center"  style="font-size: 14px;">{{ $value->bal_receive }} </td> 
                                                <td  class="text-center" style="font-size: 14px;">x</td> 
                                                <td class="text-center"  style="font-size: 14px;">{{ $value->bal_receive }} </td>  --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center col-12 btn-sm">
                                    {{ $data->links('vendor.pagination.custom') }}
                  
                                  </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">   
        $(document).ready(function() {
            $('#kit-data').DataTable( {
                dom: 'Bfrtip',
                // order: [26,'desc'],  
                buttons: [
                
                    'excelHtml5',
                    'csvHtml5'
                ]
            } );
        });


        function download(){
            var custcode               = $('#custcode').val();
            var prodno                 = $('#prodno').val();
            var custpo                 = $('#custpo').val();
            var partno                 = $('#partno').val();
        
            var url = ("{{ url('/repacking/kitdata/download') }}" + "?custcode=" + custcode + "&prodno="+ prodno + "&custpo="+custpo + "&partno="+ partno)
            window.location.assign(url);

        }
    </script>
@endsection
