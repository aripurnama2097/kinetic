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
              Partlist
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
              <div class="card rounded-1 col-12 " >
                  <h2>FILTER </h2>

                  <div class="btn-group" role="group" aria-label="Basic example">
                  {{-- FILTER PROD NO --}}
                  <form class="col-6 d-flex justify-content-lefT"id="genPartlist" >
                    <select style="font-size:15px" class="form-control col-2 btn btn-light btn-sm" id="prod-no" name = "prodno">
                     <option value="-">-- PROD NO --</option>
                     @foreach($data3 as $dd)
                      <option value="{{$dd->prodno}}">{{$dd->prodno}}</option>    
                      @endforeach               
                    </select> 
                    <button type="submit" class="btn btn-info d-none d-sm-inline-block" >
                      <i class="ti ti-filter"></i>
                    Submit              
                    </button>            
                  </form> 

                  {{-- FILTER RELEASE DATE --}}
                  <form class="col-8 d-flex justify-content-left" id="genPartlist" >
                    <select style="font-size:15px" class="form-control col-2 btn btn-light btn-sm" id="prod-no" name = "prodno">
                     <option value="-">-- RELEASE DATE --</option> --}}
                     @foreach($data3 as $dd)
                      <option value="{{$dd->prodno}}">{{$dd->prodno}}</option>    
                      @endforeach               
                    </select> 
                    <button type="submit" class="btn btn-info d-none d-sm-inline-block" >
                      <i class="ti ti-filter"></i>
                    Submit              
                    </button>
                  </form> 
                </div>
                
                  <br>
                  <br>
             
                    <div class="btn-group" role="group">
                      <div class="col-6  ">
                        <a class="btn btn-primary col-12" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          ---SCAN IN---
                        </a>
                      </div>
                      <a  class="btn btn-secondary  "data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2" >
                        <i class="ti ti-printer"></i>
                        PRINT
                      </a> 
                    </div>
                    <br>
                    <div class="collapse " id="collapseExample">
                      <div class="card card-body col-6">
                        <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="sorting_by" value="" id="sorting_by" maxlength="8" placeholder="SCAN NIK HERE" autofocus>   
                        <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="sorting_by" value="" id="sorting_by" maxlength="8" placeholder="SCAN QR PARTLIST" >  
                        <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="sorting_by" value="" id="sorting_by" maxlength="8" placeholder="INPUT PRODNO" >  
                        <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="sorting_by" value="" id="sorting_by" maxlength="8" placeholder="SCAN LABEL MC" >   
                      </div>
                    </div>

                    <div class="collapse " id="collapse2">
                      <div class="card card-body col-12">
                        <table style="width:100%"  class="text-nowrap  table table-striped border border-primary shadow-sm" >
                          {!! QrCode::size(50)->generate('a'); !!}  
                          <thead class="thead-dark">
                             <tr>     
                                                        
                               <th style ="font-size: 10px;">Cust Code</th>
                               <th style ="font-size: 10px;">Prod No</th>
                               <th style ="font-size: 10px;">Part Number</th>
                               <th style ="font-size: 10px;">Part Name</th>                       
                               <th style ="font-size: 10px;">Demand</th>                    
                               <th style ="font-size: 10px;">Actual Scan</th>
                               <th style ="font-size: 10px;">Total Scan</th>
                             </tr>
                            </thead>
               
                           <tbody>
                             @foreach($data as $key => $value)
                             <tr class="table-light">
                             
                               <td style ="font-size: 12px;">{{$value->custcode}} </td>
                               <td style ="font-size: 12px;">{{$value->prodno}} </td>
                               <td style ="font-size: 12px;">{{$value->partno}} </td>
                               <td style ="font-size: 12px;">{{$value->partname}} </td> 
                               <td style ="font-size: 12px;"> {{$value->demand}}</td>                  -
                               <td style ="font-size: 12px;"> </td>
                               <td style ="font-size: 12px;"> </td>
                             </tr>
                             @endforeach
                           </tbody>
                         </table>
                      </div>
                    </div>


                    <a href="{{url('/partlist')}}" class="btn btn-success " >
                      <i class="ti ti-360"></i>
                      Refresh
                    </a>
                 <br>
              </div>
            </div>

                  <br>
                  @if(Session::has('success'))
                  <p class="alert alert-success">{{Session::get('success')}}</p>
                  @endif
  
              
            {{-- <div class="col-12">
              <div class="card  col-12 " > --}}
                {{-- <div class="card-header  ">  --}}
                  
                {{-- </div> --}}
                
                  {{-- </div>   --}}
                 
                <div class="card-body border-bottom d-flex justify-content-center ">            
                   
                  <div class="table-responsive  rounded-1 shadow-sm  mr-5 col-8 shadow-lg ">     
                    <div class="card-header text-center justify-content-center mt-3">
                      <h2 style="font-size:30px"class="text-dark " >PART LIST MC</h2> 
                    </div>
                   <table style="width:100%" id="example" class="text-nowrap  table table-striped border border-primary shadow-sm" >
                    {!! QrCode::size(50)->generate('a'); !!}  
                    <thead class="thead-dark">
                       <tr>     
                                                  
                         <th style ="font-size: 10px;">Cust Code</th>
                         <th style ="font-size: 10px;">Prod No</th>
                         <th style ="font-size: 10px;">Part Number</th>
                         <th style ="font-size: 10px;">Part Name</th>                       
                         <th style ="font-size: 10px;">Demand</th>                    
                         <th style ="font-size: 10px;">Actual Scan</th>
                         <th style ="font-size: 10px;">Total Scan</th>
                       </tr>
                      </thead>
         
                     <tbody>
                       @foreach($data as $key => $value)
                       <tr class="table-light">
                       
                         <td style ="font-size: 12px;">{{$value->custcode}} </td>
                         <td style ="font-size: 12px;">{{$value->prodno}} </td>
                         <td style ="font-size: 12px;">{{$value->partno}} </td>
                         <td style ="font-size: 12px;">{{$value->partname}} </td> 
                         <td style ="font-size: 12px;"> {{$value->demand}}</td>                  -
                         <td style ="font-size: 12px;"> </td>
                         <td style ="font-size: 12px;"> </td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                  </div>
                  <br>
                  <br>     
                </div>
                <div class="col-12 d-flex justify-content-center">
                  <a href="{{url('/schedule')}}" class="btn btn-secondary " >
                    <i class="ti ti-360"></i>
                    Print Partlist
                  </a>
                </div>
              {{-- </div>
            </div> --}}
          </div>
        </div>    
    </div>


        
 
</div>

<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript">
          


$(document).ready(function() {
  $('#genPartlist').submit(function(event) {
 
        event.preventDefault();
        var prodNo = $('#prod-no').val();
       
        // send the AJAX request to the route
        $.ajax({
          url: "{{url('/partlist/filter/')}}",
          method: 'POST',
          data: {
            prodno: prodNo,        
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
          var data=""
            console.log(data);
            
            $.each(response,function(key, value){
            data = data + value.qrcode
            data = data + "<tr>"      
            data = data + "<td>"+value.custcode+"</td>"  
            data = data + "<td>"+value.prodno+"</td>"  
            data = data + "<td>"+value.partno+"</td>" 
            data = data + "<td>"+value.partname+"</td>" 
            data = data + "<td>"+value.demand+"</td>" 
            data = data + "</tr>"
            })
            $('tbody').html(data);
        }
       });
    });




    

//  =====================GENERATE PARLIST============================
    $('#gen-parlist').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure Generate Parlist?',
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
            url: "{{url('schedule/parlist')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Parlist Generate',
                  'success'
                    )
              }
          });
        }
      });
    });


});


  


</script>
@endsection