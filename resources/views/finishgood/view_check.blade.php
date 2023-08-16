@extends('layouts.main')
@section('section')
    <div class="page-wrapper">

        <div class="d-flex justify-content-end">
            <div id="spinner" class="spinner" style="display: none;">
              <div class="spinner-border text-info text-end" role="status">
                  <span class="sr-only">Loading...</span>
              </div>
            </div>
          </div>

        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col-12 ">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Finish Good Menu
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
            <div class="container-xl mt-1 ">
                <div class="row row-deck row-cards ">
                    <div class="col-12 ">
                        <div class="card rounded-1 col-12 ">
                            <div class="card-header text-center justify-content-center">
                                <h2 style="font-size:30px"class="text-dark "> -- FINAL CHECK--</h2>
                            </div>

                            <div class="btn-group mb-3" role="group">
                                <div class="col-6  ">
                                    <a class="btn btn-success  col-12 text-white"data-bs-toggle="collapse"   id="btn-compare"
                                        role="button" aria-expanded="false" aria-controls="skid-packing">
                                        <i class="ti ti-start"></i>
                                        COMPARE QR
                                    </a>
                                   
                                </div>
                                <div class="col-6  ">
                                    <a class="btn btn-primary   col-12 text-white"  data-bs-toggle="collapse" id="btn-check"
                                        role="button" aria-expanded="false" aria-controls="skid-packing">
                                        <i class="ti ti-start"></i>
                                        CHECK DATA SKID
                                    </a>
                                </div>                           
                            </div>                      
                        </div>
                    </div>

                    <br>
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif


                    {{-- FORM SCAN OUT --}}
                    <div class="collapse mt-4" id="compare">
                        <div class="col-12 ">
                            <div class="card rounded-1 col-12 mb-2 border border-success shadow-lg">
                                <h2 style="font-weight:bold"class="text-center text-dark"> COMPARE</h2>
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">                                              
                                    <div class="d-flex justify-content-center">
                                        <div class="row row-cards col-12 mb-4">
                                            <div class="mb-3 col-sm-12 col-12">                                            
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary text-dark "
                                                    type="text" name="qrskid" value="" id="qrskid" 
                                                    placeholder="SCAN QR SKID" autofocus>
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary text-dark"
                                                    type="text" name="qrlabel" value="" id="qrlabel" 
                                                    placeholder="SCAN QR label" disabled>                                                                                                                                                                    
                                            </div>                                      
                                        </div>                                    
                                   </div>                               
                               </div>
                           </div>
                       </div> 
                    </div>
                  
                    
                     {{-- FORM SCAN OUT --}}
                    <div class="collapse mt-4" id="check">
                        <div class="col-12 ">
                            <div class="card rounded-1 col-12 mb-2 border border-primary shadow-lg">
                                <h2 style="font-weight:bold"class="text-center text-dark mt-2"> CHECK DATA QR</h2>
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">                             
                                    {{-- <h1 class="text-dark text-center"> --SCAN OUT--</h1>                 --}}
                                    <div class="d-flex justify-content-center">
                                        <div class="row row-cards col-12 mb-4">
                                            <div class="mb-3 col-sm-12 col-12">
                                                
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="qr_skid" value="" id="qr_skid" 
                                                    placeholder="SCAN QR SKID" autofocus>
                                                 
                                                                                                                          
                                            </div>                                      
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 text-dark ml-0 " style="position:left;font-color:black;font-size:18px;font-weight:bol" id="QRText"></div>

                                    <table style="width:100%"
                                        class="text-nowrap  table border-bordered  shadow-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                {{-- <th style="font-size: 10px;">No</th> --}}
                                                <th style="font-size: 10px;">Cust Code</th>
                                                <th style="font-size: 10px;">Skid No</th>
                                                <th style="font-size: 10px;">Prod No</th>
                                                <th style="font-size: 10px;">Part Number</th>
                                                <th style="font-size: 10px;">Part Name</th>
                                                <th style="font-size: 10px;">Demand</th>
                                                <th style="font-size: 10px;">Total Running</th>
                                                <th style="font-size: 10px;">Balance Running</th>
                                            </tr>
                                        </thead>

                                        <tbody id="view-check">
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

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">
    
        $(document).ready(function() {
            const spinner = document.querySelector('#spinner');

            $('#btn-compare').on('click', function(){
          
                $('#check').hide();
                $('#compare').show();
             })

            $('#btn-check').on('click', function(){
            
                $('#compare').hide();
                $('#check').show();
            })
      

        $('#qr_skid').on('keypress', function(e) {
                if (e.which == 13) {
                    let qr_skid = $('#qr_skid').val();

                    $.ajax({
                            type: "get",
                            dataType: "json",
                            url: "{{ url('/finishgood/viewSkid/checkData/') }}",
                            data: { 
                                qr_skid : qr_skid,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {      

                                if (response.success) {
                                            var audio   = document.getElementById('audio');
                                            var source  = document.getElementById('audioSource');
                                            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                            audio.load();
                                            audio.play();


                                        swal.fire({
                                            icon: 'success',
                                            title: response.message,

                                            timer: 400,
                                            showConfirmButton: false,

                                        })
                                } 
                                else {
                                            swal.fire({
                                            icon: 'warning',
                                            title: response.message
                                        })  
                                }
                                $('#QRText').html(response.qr);
                              var data = ""                          
                              $.each(response.data, function(key, value) {
                                data = data + "<tr>"
                                    if (value.act_running == 0 && value.bal_running == 0) {
                                                data = data + "<tr class=table-light>";
                                            }
                                            if (value.act_running!= 0 && value.bal_running != 0) {
                                                data = data + "<tr class=table-warning>";
                                            }
                                            if (value.act_running == value.demand && value
                                                .bal_running == 0) {
                                                data = data + "<tr class=table-success>";
                                            }
                                    //   data = data + "<td>" + value.id + "</td>"
                                      data = data + "<td>" + value.custcode + "</td>"
                                      data = data + "<td>" + value.skid_no + "</td>"
                                      data = data + "<td>" + value.prodno + "</td>"
                                      data = data + "<td>" + value.partno + "</td>"
                                      data = data + "<td>" + value.partname + "</td>"
                                      data = data + "<td>" + value.demand + "</td>"
                                      data = data + "<td>" + value.act_running + "</td>"
                                      data = data + "<td>" + value.bal_running + "</td>"
                                  data = data + "</tr>"
                              })
                              $('#view-check').html(data);
                            }
                        })
                        $('#qr_skid').val("");
                        $('#qr_skid').focus();

                }
            })


            $('#qrskid').on('keypress', function(e) {
                if (e.which == 13) {
                    var qrskid = $('#qrskid').val();
                    if (qrskid != '') {
                        $('#qrlabel').attr('disabled', false);
                      
                        $('#qrlabel').focus();
                    }
                }
            })

            $('#qrlabel').on('keypress', function(e) {
                if (e.which == 13) {

                    // SKD20230801003:1:JK NAGANO:NA356:03:2022-06-17
                    // 1:NA356

                    var qrlabel = $('#qrlabel').val();
                    var qrskid = $('#qrskid').val();
                   
                   
                    let getskidno       = qrskid.split(":");
                    let skid_no         = getskidno[1];
                    let char            = ":";
                    let packing_no      = getskidno[3];

                    let resultskid = skid_no.concat(char,packing_no);

      	            // let skid_check      = getskidno[1] . getskidno[3] ;// GET PO KIT

                   console.log(qrlabel,resultskid);

                   if(qrlabel == resultskid){
                    swal.fire({
                                    icon: 'success',
                                    title: 'Oke',
                                    showConfirmButton :false,
                                    timer:1000


                                })
                    // if(qrskid.search(qrlabel)>= 0){
                                                                var audio = document.getElementById('audio');
                                                                var source = document.getElementById('audioSource');
                                                                var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                                                audio.load()
                                                                audio.play();
                                                                return;                                           
                    $('#qrskid').focus();
                   $('#qrskid').val("");
                   $('#qrlabel').val("");
                  
                   }
                   else{
                    swal.fire({
                                    icon: 'error',
                                    title: 'WRONG',
                                    showConfirmButton :false,
                                    timer:1000


                                })

                                                                var audio = document.getElementById('audio');
                                                                var source = document.getElementById('audioSource');
                                                                var audio = new Audio("{{asset('')}}storage/sound/WRONG.mp3");
                                                                audio.load()
                                                                audio.play();
                                                                return;     
                    // alert("Please Check Content Skid");

                   }

                   $('#qrskid').focus();
                   $('#qrskid').val("");
                   $('#qrlabel').val("");
                }
            })
    });

    function printskid(){
            let packing_no           = $('#packing_no').val();
            let skid_no              = $('#skid_no').val();
            let custpo               = $('#custpo').val();
            let vandate              = $('#vandate').val();
            let dest                 = $('#dest').val();
            let type_skid            = $('#type_skid').val();
            
            window.location.assign(       "{{ url('/finishgood/viewSkid/printSkid') }}" + "?packing_no=" + packing_no + "&skid_no=" + skid_no + "&custpo=" + custpo + "&vandate=" + vandate +"&dest=" + dest + "&type_skid=" + type_skid  )
        }


       
    </script>
@endsection
