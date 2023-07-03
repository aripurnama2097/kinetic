@extends('layouts.main')
<head>
  <style>
thead {
        background-color: #1c87c9;
        color: #ffffff;
      }
  </style>
<head>
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
      </div>
    
        <div class="container-xl mt-1 ">
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 col-12 " >
                 
                  <br>
                  <br>
               
                    <div class="btn-group" role="group">
                      <a  class="btn btn-primary  "data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2" >
                        <i class="ti ti-printer"></i>
                        PARTLIST SCHEDULE
                      </a> 
                       <div class="col-6  ">
                        <a class="btn btn-light col-12" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          ---SCAN IN---
                        </a>
                      </div>
                    </div>

                    <br>
                  

                 

                    <div class="collapse mt-4" id="collapse2">
                      <div class="card card-body col-12 mt-4">
                        <h2>FILTER </h2>

                        <div class="btn-group" role="group" aria-label="Basic example">
                        {{-- FILTER PROD NO --}}
                        <form class="col-12 d-flex justify-content-left" id="print-Partlist" >
                          {{-- <input type="date" class="form-control rounded-3 form-control-sm col-2" name="jkeipodate" id="release-date" value="{{date('Y-m-d')}}">	 --}}
                          <select style="font-size:15px" class="form-control col-2 btn btn-light btn-sm" id="filtprod-no" name = "prodno">
                           <option value="-">-- PROD NO --</option>
                           @foreach($dataprodno as $dd)
                            <option value="{{$dd->prodno}}">{{$dd->prodno}}</option>    
                            @endforeach               
                          </select> 
                          <button type="submit" class="btn btn-info d-none d-sm-inline-block" >
                            <i class="ti ti-filter"></i>
                          View             
                          </button>            
                        </form> 
                      
                      </div>
                      
                      <br>
                      <br>
                          <h2 id="judul" style="font-size:30px"class="text-dark text-center " >PART LIST MC</h2>                          
                      <br>    
                      {{-- <iframe id="print-iframe"> --}}
                        
                        <p id="table-print1">{!! QrCode::size(50)->generate('test'); !!} </p>
                        <div class="table-responsive  rounded-1 shadow-sm  mr-5 col-12 shadow-lg ">     
                        <table style="width:100%" id="table-print" class="text-nowrap  table table-striped border border-dark shadow-sm" >
                          <br>
                          <thead class="thead-dark">
                             <tr>      
                              <th style ="font-size: 10px;">Part list No</th>                                 
                               <th style ="font-size: 10px;">Cust Code</th>
                               <th style ="font-size: 10px;">Prod No</th>
                               <th style ="font-size: 10px;">JKEI Po date</th>
                               <th style ="font-size: 10px;">van Date</th>
                               <th style ="font-size: 10px;">Part Number</th>
                               <th style ="font-size: 10px;">Part Name</th>                       
                               <th style ="font-size: 10px;">Demand</th>                    
                               <th style ="font-size: 10px;">Std Pack</th>
                               {{-- <th style ="font-size: 10px;">MC Shelf No</th> --}}
                               <th style ="font-size: 10px;">Vendor</th>
                             </tr>
                            </thead>
               
                           <tbody id="data-print">
                             {{-- @foreach($data as $key => $value)
                             <tr class="table-light">   
                              <td style ="font-size: 12px;">{{$value->partlist_no}} </td>                          
                               <td style ="font-size: 12px;">{{$value->custcode}} </td>
                            
                               <td style ="font-size: 12px;">{{$value->prodno}} </td>
                               <td style ="font-size: 12px;">{{$value->vandate}} </td>
                               <td style ="font-size: 12px;">{{$value->partno}} </td>
                               <td style ="font-size: 12px;">{{$value->partname}} </td> 
                               <td style ="font-size: 12px;"> {{$value->demand}}</td>                  -
                               <td style ="font-size: 12px;">{{$value->stdpack}} </td>
                               <td style ="font-size: 12px;"> </td>
                              
                               
                             </tr>
                             @endforeach --}}
                           </tbody>
                         </table>
                        </div>
                      {{-- </iframe> --}}
                      </div>
                      <button id ="print-btn" class="print-button float-right btn btn-primary"> Print<i class="ti ti-printer"></i></button>                  
                    </div>   

                      {{-- DATA SCAN IN --}}
                      <div class="collapsed-flex justify-content-right " id="collapseExample">
                        <p class="text-dark text-center" style="font-size:20px;font-weight:bold"> MC Issue Planning </p>
                        <div class="card card-body col-12 border border-secondary shadow-lg">
                         
                          <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="scan_nik" value="" id="scan_nik" maxlength="8" placeholder="SCAN NIK HERE" autofocus >   
                          <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="parlist_no" value="" id="partlist_no"  placeholder="INPUT PART LIST NO" disabled >  
                          <input class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center" type="text" name="scan_label" value="" id="scan_label"  placeholder="SCAN LABEL MC" disabled >  
                        <div class="col-12 d-flex justify-content-end">
                          <button class="btn btn-info" onclick="document.getElementById('scan_label').value = ''">Clear</button>
                        </div>
                        </div>
                        <div class="card-body border-bottom d-flex justify-content-center ">                   
                          <div class="table-responsive  rounded-1 shadow-sm  mr-5 col-8 shadow-lg ">     
                            {{-- <div class="card-header text-center justify-content-center mt-3">
                              <h2 style="font-size:30px"class="text-dark " >SCAN ISSUE</h2> 
                            </div> --}}
                           <table style="width:100%"  class="text-nowrap  table border-bordered border border-primary shadow-sm">    
                            <thead class="thead-dark">
                               <tr>      
                                <th style ="font-size: 10px;">No</th>                       
                                 <th style ="font-size: 10px;">Cust Code</th>
                                 <th style ="font-size: 10px;">Prod No</th>
                                 <th style ="font-size: 10px;">Part Number</th>
                                 <th style ="font-size: 10px;">Part Name</th>                       
                                 <th style ="font-size: 10px;">Demand</th>                    
                                 <th style ="font-size: 10px;">Actual Scan</th>
                                 <th style ="font-size: 10px;">Total Scan</th>
                               </tr>
                              </thead>
                 
                             <tbody id="data-scanin">   
                              @foreach($data as $u)  
                              <tr>
                                <?php if ($u->tot_scan == NULL) {
                                  echo '<tr style="background-color: rgb(144, 144, 144);">';
                              } else {
                                  echo '<tr style="background-color:#82d489;">';
                                      // echo '<tr style="background-color:#00c292;">';
                              }?>     
                              </tr> 
                              @endforeach                        
                             </tbody>
                           </table>
                          </div>
                          <br>
                          <br>     
                        </div>
                      </div>
                  <br>
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
          </div>
        </div>    
    </div>
</div>

<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript">
          
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});  

$(document).ready(function() {

  $('#partlist').dataTable( {
      "paging": true,
      // dom: 'rBfrtip',
      //     buttons: [
      //         'print','csv'
      //     ],
      // position :'bottom'

  });


// ==============PRINT PARTLIST==========================
  $('#print-btn').click(function() {
        var iframe = document.createElement('iframe');
        iframe.style.display = 'oke';
        document.body.appendChild(iframe);

        var content = '<html><head><title>Partlist MC</title></head><body>' +
                       +  $('#judul').clone().wrap('<div>').parent().html() + $('#table-print1').clone().wrap('<div>').parent().html() + 
                      $('#table-print').clone().wrap('<div>').parent().html() +
                      '</body></html>';

        var doc = iframe.contentWindow.document;
        doc.open();
        doc.write(content);
        doc.close();

        iframe.contentWindow.focus();
        iframe.contentWindow.print();
      });






      // ========================FIlter PRINT PARTLIST=================================
    $('#print-Partlist').submit(function(event) {
 
    event.preventDefault();
    var prodNo = $('#filtprod-no').val();
    // var releaseDate = $('#release-date').val();
 

    // send the AJAX request to the route
    $.ajax({
      url: "{{url('/partlist/filterProdno/')}}",
      method: 'POST',
      data: {
        prodno: prodNo, 
        // jkeipodate:releaseDate,       
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
      var data=""
        console.log("data partlist",data);   
        $.each(response,function(key, value){
      
        data = data + "<tr>"    
        data = data + "<td>"+value.partlist_no+"</td>"   
        data = data + "<td>"+value.custcode+"</td>"  
        data = data + "<td>"+value.prodno+"</td>"  
        data = data + "<td>"+value.jkeipodate+"</td>"  
        data = data + "<td>"+value.vandate+"</td>"  
        data = data + "<td>"+value.partno+"</td>" 
        data = data + "<td>"+value.partname+"</td>" 
        data = data + "<td>"+value.demand+"</td>" 
        data = data + "<td>"+value.stdpack+"</td>" 
        data = data + "<td>"+value.vendor+"</td>" 
      
        data = data + "</tr>"
        })
        $('#data-print').html(data);
    }
    });
    });



  //  ===============SCAN  IN PROCESSS=================================
  $("#scan_nik").focusin(function(){
        $(this).css("background-color", "lightgreen");
    });
    $("#partlist_no").focusin(function(){
        $(this).css("background-color", "lightgreen");
    });
    $("#scan_label").focusin(function(){
        $(this).css("background-color", "lightgreen");
    });
// =========


  $('#scan_nik').on('keypress', function(e){
        if(e.which == 13) {
        var val_nik = $('#scan_nik').val();
            if (val_nik != '') {
                $('#partlist_no').attr('disabled', false);
                $('#scan_label').attr('disabled', false);
                $('#partlist_no').focus();
            }                       
        } 
    })


    //STEP 1.  DAPATKAN DATA PARTLIST NUMBER
    $('#partlist_no').on('keypress', function(e){
        if(e.which == 13) {
            let val_partlistNo = $('#partlist_no').val();
            if (val_partlistNo != '') {
                $('#scan_label').attr('disabled', false);
                // $('#scan_label').focus();
              var partlistNo = $('#partlist_no').val();
            

              // SEND AJAX REQUEST DATA
                $.ajax({
                url: "{{url('/partlist/filter_scan/')}}",
                method: 'POST',
                data: {
                  partlist_no: partlistNo,        
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                var dataScan=""
                  console.log("dataScan partlist",dataScan);   
                  $.each(response,function(key, value){ 

                    dataScan = dataScan + "<tr>"   
                    dataScan = dataScan + "<td>"+value.id+"</td>"     
                    dataScan = dataScan + "<td>"+value.custcode+"</td>"  
                    dataScan = dataScan + "<td>"+value.prodno+"</td>"  
                    // dataScan = dataScan + "<td>"+value.vandate+"</td>"  
                    dataScan = dataScan + "<td>"+value.partno+"</td>" 
                    dataScan = dataScan + "<td>"+value.partname+"</td>" 
                    dataScan = dataScan + "<td>"+value.demand+"</td>"
                    dataScan = dataScan + "<td>"+value.scan_issue+"</td>" 
                    dataScan = dataScan + "<td>"+value.tot_scan+"</td>"                   
                    dataScan = dataScan + "</tr>"
                    })
                    $('#data-scanin').html(data);
                     }
                  });
              }
          }
    });


    //STEP 2. SCAN LABEL MC 
      $('#scan_label').on('keypress', function(e){
			if(e.which == 13) {

        // var parlistno = $('#partlist_no').val();
        var scan_label = $('#scan_label').val();

          $.ajax({
            type    :"POST",
            dataType:"json",
            url     :"{{url('/partlist/scan_issue/')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data    :{scan_label:scan_label},
            success : function(response){                      
            console.log("scan part label" , data);
        

            // var data=""
            console.log(data);
            data = data + "<tr>"   
            data = data + "<td>"+value.id+"</td>"     
            data = data + "<td>"+value.custcode+"</td>"  
            data = data + "<td>"+value.prodno+"</td>"  
            // data = data + "<td>"+value.vandate+"</td>"  
            data = data + "<td>"+value.partno+"</td>" 
            data = data + "<td>"+value.partname+"</td>" 
            data = data + "<td>"+value.demand+"</td>" 
            data = data + "<td>"+value.scan_issue+"</td>" 
            data = data + "<td>"+value.tot_scan+"</td>" 
            data = data + "</tr>"
          
            $('#data-scanin').html(data);
            }
            
          

            })                            
        }
        
      
    });
    // ========================END SCAN  IN PROCESSS================================




});


</script>
@endsection