@extends('layouts.main')

@section('section')
 
<style>

/* .bg-problem{
  background-color: black;
} */

.bg-dark{
  background-color: black;
}
.bg-borrow{
  background-color: #ffe2e6;
}

.bg-history{
  background-color: whitesmoke
}

.bg-user{
 background-color: #bdf5bd;;
}
.outset{
  border-bottom-style:outset;
  color:aqua;
}
        

</style>
<div class="page">
  <div class="page-wrapper">
    <!-- START Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
          @if (Auth::user()->role === 'Super Admin'||Auth::user()->role === 'Admin Planning')

          <div class="col-sm-6 col-lg-3" data-bs-toggle="collapse" id="btn-problem"  role="button"
                       aria-expanded="false" aria-controls="partlist">
            <div class="card blink bg-black">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="col-12">
                    <div class="row">
                      <h6 style="font-size:13px"  class="text-light col-4 text-start outset">{{$monthly}}</h6> 
                      <h6   style="font-size:13px" class="text-light col-8 text-center outset">PROBLEM FOUND</h6> 
                  </div>
                  </div>
                  
                </div>
                <div class="h1 mb-3"></div>
                <div class="d-flex mb-2">
                  <div class="align-content-around text-primary">
                    <p class="text-center text-light" style="font-weight:bold;font-size:25px">{{$tot_problem[0]->total_problem}} </p>
                  </div>             
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3"  data-bs-toggle="collapse" id="btn-borrow"  role="button"
          aria-expanded="false" aria-controls="partlist">
            <div class="card blink bg-borrow">
              <div class="card-body ">
                <div class="d-flex align-items-center">
                  <div class="col-12">
                    <div class="row">
                      <h6 style="font-size:13px"  class="text-dark col-4 text-start outset">{{$monthly}}</h6> 
                      <h6   style="font-size:13px" class="text-dark  col-8 text-center outset">BORROW UNCLEAR</h6> 
                  </div>
                  </div>
                </div>
                <div class="h1 mb-3"></div>
                <div class="d-flex mb-2">
                  <div class="align-content-around text-primary">
                    <p class="text-center text-dark align-center" style="font-weight:bold;font-size:20px">{{$tot_borrow_unclear[0]->total_borrow_unclear}} </p>
                  </div>                
                </div>
               
              </div>
            </div>
          </div>


        <div class="col-sm-6 col-lg-3" data-bs-toggle="collapse" id="btn-borrow-clear"  role="button" aria-expanded="false" aria-controls="partlist">
            <div class="card bg-history">
              <div class="card-body">
                <div class="d-flex align-items-center">            
                    <div class="col-12">
                      <div class="row">
                        <h6 style="font-size:13px" class="text-dark col-4 text-start outset">{{$monthly}}</h6> 
                        <h6   style="font-size:13px" class="text-dark col-8 text-rnf outset">HISTORY BORROW</h6> 
                    </div>
                    </div>
                  </div> 
                  <div class="h1 mb-3"></div>
                  <div class="d-flex mb-0">
                    <div class="align-content-around text-primary">
                      <p class="text-center text-dark align-center" style="font-weight:bold;font-size:20px">{{$tot_borrow_clear[0]->total_borrow_clear}} </p>
                    </div>                
                  </div>                
              </div>
            </div>
        </div>


          <div class="col-sm-6 col-lg-3 " data-bs-toggle="collapse" id="btn-shipping"  role="button"
          aria-expanded="false" aria-controls="partlist">
            <div class="card bg-user">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="col-12">
                    <div class="row">
                      <h6 style="font-size:13px" class="text-dark col-4 text-start outset">{{$monthly}}</h6> 
                      <h6   style="font-size:13px" class="text-dark col-8 text-center outset">TOTAL SHIPPING</h6> 
                  </div>
                  </div>
                </div>
                <div class="h1 mb-3"></div>
                  <div class="d-flex mb-0">
                    <div class="align-content-around text-primary">
                      <p class="text-center text-dark align-center" style="font-weight:bold;font-size:20px">{{$total_shipping[0]->total_shipping}} </p>
                    </div>                
                  </div>  
              
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row row-cards">          
            </div>
          </div>

          @endif
  
          <div class="col-12">
            <div class="card card-md">
              <div class="card-stamp card-stamp-lg">
                <div class="card-stamp-icon bg-primary">
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class=" col-12  ">
              {{-- DATA PROBLEM --}}
             
               <div class="row mt-2">               
                <div class="collapse mt-4" class="col-5 card " id="data-problem" hide>
                  <h4 class="card-title">PROBLEM FOUND</h4>
                  <div class="card bg-light">
                    <div class="table-responsive  rounded-1 shadow-sm">
                      <table style="width:100%" id="problem-data"  class="table table-vcenter table-striped">
                          <thead >
                              <tr class="headings">                   
                                 
                                  <th class="text-center" style="font-size: 10px;">Dest</th>
                                  <th class="text-center" style="font-size: 10px;">Model</th>
                                  <th class="text-center" style="font-size: 10px;">Prod No</th>
                                  {{-- <th class="text-center" style="font-size: 10px;">Lot Qty</th> --}}
                                  <th class="text-center" style="font-size: 10px;">VanDate</th>
                                  {{-- <th class="text-center" style="font-size: 10px;">Via</th> --}}
                                  <th class="text-center" style="font-size: 10px;">Cust PO</th>
                                  <th class="text-center" style="font-size: 10px;">Part Number</th>
                                  <th class="text-center" style="font-size: 10px;">Part Name</th>
                                  <th class="text-center" style="font-size: 10px;">Demand</th>
                                 
                                  <th class="text-center" style="font-size: 10px;">Symptom</th>
            
                                  <th class="text-center" style="font-size: 10px;">Foto</th>
                                  <th class="text-center" style="font-size: 10px;">Time Found</th>
                                  <th class="text-center" style="font-size: 10px;">Found By</th>
                                  <th class="text-center" style="font-size: 10px;">DIC</th>
                                  <th class="text-center" style="font-size: 10px;">Cause</th>
                              </tr>
                          </thead>
            
                          <tbody>
                              @foreach ($dataproblem as $key => $value)             
                              <td style="font-size: 12px;">{{ $value->dest }}</td>
                              <td style="font-size: 12px;"> {{ $value->model }}</td>
                              <td style="font-size: 12px;"> {{ $value->prodno }}</td> 
                              {{-- <td style="font-size: 12px;">{{ $value->lotqty }} </td> --}}
                              <td style="font-size: 12px;"> {{ $value->vandate }}</td>
                              {{-- <td style="font-size: 12px;"> {{ $value->shipvia }}</td> --}}
                              <td style="font-size: 12px;">{{ $value->custpo }} </td>
                              <td style="font-size: 12px;">{{ $value->partno }} </td>
                              <td style="font-size: 12px;">{{ $value->partname }} </td>
                              <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                           
                              <td style="font-size: 12px;"> {{ $value->symptom }}</td>
                              <td style="font-size: 12px;"><img width="30%" class="img-circle" src="{{ url('/public/img') }}"> </td>
                              <td style="font-size: 12px;">{{$value->created_at}}</td>
                              <td style="font-size: 12px;">{{$value->found_by}}</td>           
                              <td style="font-size: 12px;">{{$value->dic}} </td>
                              <td style="font-size: 12px;">{{$value->cause}} </td>
                         
                             
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  </div>
                </div>
              </div>
              
                {{-- DATA BORROW--}}
              {{-- <div class="card"> --}}
                <div class="collapse mt-4" class="col-6 card ml-3" id="data-borrow" hide>
                  <h4 class="card-title">BORROW UNCLEAR</h4>
                   <div class="card bg-light">
                    <div class="table-responsive  rounded-1 shadow-sm mt-3"hide>
                      <table style="width:100%" id="kit-monitor"  class="table table-vcenter table-striped">
                          <thead >
                              <tr class="headings">                   
                                 
                                <th style="font-size: 14px;">Custpo</th>
                                <th style="font-size: 14px;">Partno</th>
                                <th style="font-size: 14px;">Qty</th>
                                <th style="font-size: 14px;">Symptom</th>            
                                <th style="font-size: 14px;">Borrower</th>
                                <th style="font-size: 14px;">Lender</th>
                                <th style="font-size: 14px;">Dateout</th>
                                <th style="font-size: 14px;">Status</th>
                                <th style="font-size: 14px;">Dept</th>
                                <th style="font-size: 14px;">Reason</th>
                                <th style="font-size: 14px;">Est return</th>
                                <th style="font-size: 14px;">Act return</th>
                                <th style="font-size: 14px;">Dic return</th>
                                <th style="font-size: 14px;">Receiver</th>
                                <th style="font-size: 14px;">Total Return</th>
                                <th style="font-size: 14px;">Diff</th>
                                <th style="font-size: 14px;">Create</th>
        
                              </tr>
                          </thead>
        
                          <tbody>
                              @foreach ($databorrow as $key => $value)
                              <tr>
                            <td style=font-size:14px>{{$value->custpo }}</td>
                            <td style=font-size:14px>{{$value->partno }}</td>
                            <td style=font-size:14px>{{$value->qty}}</td>
                            <td style=font-size:14px>{{$value->symptom }}</td>
                            <td style=font-size:14px>{{$value->borrower }}</td>
                            <td style=font-size:14px>{{$value->lender }}</td>
                            <td style=font-size:14px>{{$value->dateout }}</td>
                            <td style=font-size:14px>{{$value->status }}</td>
                            <td style=font-size:14px>{{$value->dept }}</td>
                            <td style=font-size:14px>{{$value->reason }}</td>
                            <td style=font-size:14px>{{$value->est_return }}</td>
                            <td style=font-size:14px>{{$value->act_return }}</td>
                            <td style=font-size:14px>{{$value->dic_return }}</td>
                            <td style=font-size:14px>{{$value->receiver }}</td>
                            <td style=font-size:14px>{{$value->tot_return }}</td>
                            <td style=font-size:14px>{{$value->diff }}</td>
                            <td style=font-size:14px>{{$value->created_at }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              {{-- </div> --}}

                 {{-- DATA BORROW CLEAR--}}
              {{-- <div class="card"> --}}
                 <div class="collapse mt-4" class="col-6 card ml-3" id="borrow-clear" hide>
                  <h4 class="card-title">HISTORY BORROW</h4>
                   <div class="card bg-light">
                    <div class="table-responsive  rounded-1 shadow-sm mt-3"hide>
                      <table style="width:100%" id="kit-monitor"  class="table table-vcenter table-striped">
                          <thead >
                              <tr class="headings">                   
                                 
                                <th style="font-size: 14px;">Custpo</th>
                                <th style="font-size: 14px;">Partno</th>
                                <th style="font-size: 14px;">Qty</th>
                                <th style="font-size: 14px;">Symptom</th>            
                                <th style="font-size: 14px;">Borrower</th>
                                <th style="font-size: 14px;">Lender</th>
                                <th style="font-size: 14px;">Dateout</th>
                                <th style="font-size: 14px;">Status</th>
                                <th style="font-size: 14px;">Dept</th>
                                <th style="font-size: 14px;">Reason</th>
                                <th style="font-size: 14px;">Est return</th>
                                <th style="font-size: 14px;">Act return</th>
                                <th style="font-size: 14px;">Dic return</th>
                                <th style="font-size: 14px;">Receiver</th>
                                <th style="font-size: 14px;">Total Return</th>
                                <th style="font-size: 14px;">Diff</th>
                                <th style="font-size: 14px;">Create</th>
        
        
                              </tr>
                          </thead>
        
                          <tbody>
                              @foreach ($history_borrow as $key => $value)
                              <tr>
                            <td style=font-size:14px>{{$value->custpo }}</td>
                            <td style=font-size:14px>{{$value->partno }}</td>
                            <td style=font-size:14px>{{$value->qty}}</td>
                            <td style=font-size:14px>{{$value->symptom }}</td>
                            <td style=font-size:14px>{{$value->borrower }}</td>
                            <td style=font-size:14px>{{$value->lender }}</td>
                            <td style=font-size:14px>{{$value->dateout }}</td>
                            <td style=font-size:14px>{{$value->status }}</td>
                            <td style=font-size:14px>{{$value->dept }}</td>
                            <td style=font-size:14px>{{$value->reason }}</td>
                            <td style=font-size:14px>{{$value->est_return }}</td>
                            <td style=font-size:14px>{{$value->act_return }}</td>
                            <td style=font-size:14px>{{$value->dic_return }}</td>
                            <td style=font-size:14px>{{$value->receiver }}</td>
                            <td style=font-size:14px>{{$value->tot_return }}</td>
                            <td style=font-size:14px>{{$value->diff }}</td>
                            <td style=font-size:14px>{{$value->created_at }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              {{-- </div> --}}

                {{-- DATA SHIPPING--}}
              <div class="card">
                  <div class="collapse mt-4" class="col-6 card ml-3" id="shipping" hide>
                    <h4 class="card-title text-dark">                   
                        <img src ="{{asset('../public/css/barang.png')}}" alt="Logo JKEI" width="60px">
                    SHIPPING MONTH
                  </h4>
                     <div class="card bg-light">
                      <div class="table-responsive  rounded-1 shadow-sm mt-3"hide>
                        <table style="width:100%" id="table-shipping"  class="table table-vcenter table-striped">
                            <thead >
                                <tr class="headings">                                                     
                                  <th style="font-size: 14px;">Custcode</th>
                                  <th style="font-size: 14px;">Dest</th>
                                  <th style="font-size: 14px;">Prodno</th>
                                  <th style="font-size: 14px;">Order item</th>
                                  <th style="font-size: 14px;">Jkei PO Date</th>            
                                  <th style="font-size: 14px;">Vandate</th>
                                  <th style="font-size: 14px;">ETD</th>
                                  <th style="font-size: 14px;">ETA</th>
                                  <th style="font-size: 14px;">Shipvia</th>
                                  <th style="font-size: 14px;">Invoice Number </th>         
                                </tr>
                            </thead>
          
                            <tbody>
                                @foreach ($datashipping as $key => $value)
                                <tr>
                              <td style=font-size:14px>{{$value->custcode }}</td>
                              <td style=font-size:14px>{{$value->dest }}</td>
                              <td style=font-size:14px>{{$value->prodno}}</td>
                              <td style=font-size:14px>{{$value->orderitem }}</td>
                              <td style=font-size:14px>{{$value->jkeipodate }}</td>
                              <td style=font-size:14px>{{$value->vandate }}</td>
                              <td style=font-size:14px>{{$value->etd}}</td>
                              <td style=font-size:14px>{{$value->eta }}</td>
                              <td style=font-size:14px>{{$value->shipvia }}</td>
                              <td style=font-size:14px>{{$value->invoice_no }}</td>
                          
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
    {{-- <======END PAGE BODY==============> --}}
  </div>
</div>

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
<script type="text/javascript">   
    $(document).ready(function() {
        $('#table-shipping').DataTable( {
          paging:true
        } );

        $('#btn-problem').on('click', function(){
                $('#data-borrow').hide();
                $('#borrow-clear').hide();
                $('#shipping').hide();
                $('#data-problem').show();
            })

        $('#btn-borrow').on('click', function(){
               $('#data-problem').hide();
               $('#borrow-clear').hide();
               $('#shipping').hide();
                $('#data-borrow').show();
            })

            $('#btn-borrow-clear').on('click', function(){
               $('#data-problem').hide();
               $('#data-borrow').hide();
               $('#shipping').hide();
               $('#borrow-clear').show();
            })

            $('#btn-shipping').on('click', function(){
               $('#data-problem').hide();
               $('#data-borrow').hide();
               $('#borrow-clear').hide();
               $('#shipping').show();
            })
          


      });
</script>
@endsection