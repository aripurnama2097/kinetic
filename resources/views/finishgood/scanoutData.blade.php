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
   
    <div class="col-12 bg-light">
        <div class="card  ">
            <h2 style="font-weight:bold" class="page-title text-dark ml-4 mt-3"> FINISHGOOD - SCAN OUT </h2>
          {{-- <div class="card-header">
            <h3 class="card-title">SCAN OUT</h3>
          </div> --}}
          <div class="card-body border-bottom py-3">
            <form class="mt-2 mb-2"action="{{url('finishgood/scanoutData')}}" method="GET">			
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
              <a class="btn btn-success btn-sm" href="{{ url('/finishgood/scanoutData') }}"> Refresh <i
                class="ti ti-refresh"></i> </a>
            </div>
        </form>
        <button class="btn btn-dark btn-sm " onclick="downloadfg()"><i class="ti ti-download"></i> Download</button>
         
          <div class="table-responsive  rounded-1 shadow-lg mt-2 ">
            <table style="width:100%"  class="table table-striped border border-primary shadow-sm">
               
                <thead class="thead-dark" >
                    <tr class="headings">
                        <th style="font-size: 12px;">No</th> 
                        <th style="font-size: 12px;">Customer Code</th>                                          
                        <th style="font-size: 12px;">Dest</th>
                        <th style="font-size: 12px;">Attent</th>
                        <th style="font-size: 12px;">Model</th>
                        <th style="font-size: 12px;">Prod No</th>
                        <th style="font-size: 12px;">Lot Qty</th>
                        <th style="font-size: 12px;">shpvia</th>
                        {{-- <th style="font-size: 12px;">JKEI-Po</th> --}}
                        <th style="font-size: 12px;">VanDate</th>
                        <th style="font-size: 12px;">Order-Item</th>
                        <th style="font-size: 12px;">Cust PO</th>
                        <th style="font-size: 12px;">Part Number</th>
                        <th style="font-size: 12px;">Part Name</th>
                        <th style="font-size: 12px;">Demand</th>
                        {{-- <th style="font-size: 12px;">Box No</th>
                        <th style="font-size: 12px;">SKID No</th> --}}
                        <th style="font-size: 12px;">Actual Running</th>
                        <th style="font-size: 12px;">Balance Running</th>
    
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($data as $key => $value)
                     
                        <td class="text-center"style="font-size: 13px;"> {{ ++$i}}</td>
                        <td class="text-center" style="font-size: 12px;font-weight:bold"> {{ $value->custcode }}</td>
                        <td class="text-center"style="font-size: 13px;"> {{ $value->dest }}</td>
                        <td class="text-center" style="font-size: 13px;"> </td>
                        <td class="text-center" style="font-size: 13px;"> {{ $value->model }}</td>
                        <td class="text-center" style="font-size: 13px;"> {{ $value->prodno }}</td>
                        <td class="text-center" style="font-size: 13px;"> </td>
                        <td class="text-center" style="font-size: 13px;"> </td>
                        {{-- <td class="text-center" style="font-size: 13px;">{{$value->jkeipodate}}</td> --}}
                        <td class="text-center" style="font-size: 13px;"> {{ $value->vandate }}</td>                      
                        <td class="text-center" style="font-size: 13px;"> {{ $value->orderitem }}</td>
                        <td class="text-center" style="font-size: 13px;">{{ $value->custpo }} </td>
                        <td class="text-center" style="font-size: 13px;">{{ $value->partno }} </td>
                        <td class="text-center" style="font-size: 13px;">{{ $value->partname }} </td>    {{-- <td class="text-center" style="font-size: 13px;"> </td> --}}
                        <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                        {{-- <td class="text-center" style="font-size: 14px;"> {{ $value->box_no}}</td>
                        <td class="text-center" style="font-size: 14px;"> {{ $value->skid_no}}</td> --}}
                        <td class="text-primary text-center"   style="font-size: 14px; font-weight:bold"> {{ $value->act_running }}</td>
                        <td class="text-danger text-center" style="font-size: 14px;font-weight:bold">{{ $value->bal_running }} </td> 
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


    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#schedule-release').DataTable( {
                dom: 'Bfrtip',
                order: [7,'desc'],
                buttons: [
                
                    'excelHtml5',
                    'csvHtml5'
                ]
    } );

        });


        function downloadfg(){
            var custcode               = $('#custcode').val();
            var prodno                 = $('#prodno').val();
            var custpo                 = $('#custpo').val();
            var partno                 = $('#partno').val();
        
            var url = ("{{ url('finishgood/scanoutData/download') }}" + "?custcode=" + custcode + "&prodno="+ prodno + "&custpo="+custpo + "&partno="+ partno)
            window.location.assign(url);

        }
    </script>
@endsection
