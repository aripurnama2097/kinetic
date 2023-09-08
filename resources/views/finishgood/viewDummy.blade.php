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
            <div class="container-xl">
                {{-- <div class="row row-deck row-cards">
        
        </div> --}}
            </div>

            <div class="container-xl mt-1 ">
                <div class="row row-deck row-cards ">
                    <div class="col-12 ">
                        <div class="card rounded-1 col-12 ">
                            <div class="card-header text-center justify-content-center">
                                {{-- <h2 style="font-size:30px"class="text-dark ">--PACKING SKID CATEGORY-</h2> --}}
                            </div>

                            <div class="btn-group mb-3" role="group">
                                {{-- <div class="col-6  ">
                                    <a class="btn btn-primary   col-12" data-bs-toggle="collapse" href="#skid-packing"
                                        role="button" aria-expanded="false" aria-controls="skid-packing">
                                        <i class="ti ti-box"></i>
                                        Print Skid
                                    </a>
                                </div> --}}
                                <div class="col-12  ">
                                    <a class="btn btn-info col-12" data-bs-toggle="collapse" href="#scan-out"
                                    role="button" aria-expanded="false" aria-controls="scan-out">
                                        <i class="ti ti-box"></i>
                                        Scan Out Dummy
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
                    <div class="collapsed-flex justify-content-center " id="scan-out">
                        <div class="col-12 ">
                            <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                {{-- <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                    <i class="ti ti-printer"></i> </a> --}}
                                <a class="btn btn-success mb-2" href="{{ url('finishgood/viewSkid') }}"> Refresh <i
                                        class="ti ti-refresh"></i> </a>
                                <a class="btn btn-warning mb-2" href="{{ url('finishgood') }}"> Back <i
                                        class="ti ti-back"></i> </a>                                  
                                </div>
                            <div class="card rounded-1 col-12 mb-2">
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">                             
                                    <h1 class="text-dark text-center"> --SCAN OUT DUMMY--</h1>                
                                    <div class="d-flex justify-content-center">
                                        <div class="row row-cards col-12 mb-4">
                                            <div class="mb-3 col-sm-12 col-12">
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="scan_nik" value="" id="scan_nik" 
                                                    placeholder="SCAN NIK" autofocus>
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="qr_skid" value="" id="qr_skid" 
                                                    placeholder="SCAN QR SKID"disabled>
                                                <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                    type="text" name="skid_height" value="" id="skid_height"
                                                    placeholder="SKID HEIGHT" disabled>    
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="kit_label" value="" id="kit_label" 
                                                    placeholder="KIT LABEL"  disabled>                                                                                         
                                            </div>                                      
                                        </div>
                                        
                                    </div>
                                        <table style="width:100%"
                                        class="text-nowrap  table border-bordered  shadow-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="font-size: 10px;">No</th>
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

                                        <tbody id="view-scanout">
                                        </tbody>
                                    </table>
                                    <a  id="print-master" onclick="printMaster()" class="btn btn-secondary text-white  col-12 mb-3" disabled><i class="ti ti-print"></i>
                                        Print Skid
                                    </a>
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

            // START PRINT SKID
            $('#packing_no').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_packing_no = $('#packing_no').val();
                    if (val_packing_no != '') {
                     
                        $('#skid_no').attr('disabled', false);
                        $('#skid_no').focus();
                    }
                }
            })


            $('#skid_no').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_skid_no = $('#skid_no').val();
                    if (val_skid_no != '') {
                     
                        $('#custpo').attr('disabled', false);
                        $('#custpo').focus();
                    }
                }
            })

            $('#custpo').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_custpo = $('#custpo').val();
                    if (val_custpo != '') {
                     
                        $('#vandate').attr('disabled', false);
                        $('#vandate').focus();
                    }
                }
            })


            $('#vandate').on('click', function(e) {
                    var val_vandate = $('#vandate').val();                    
                        $('#dest').attr('disabled', false);
                        $('#dest').focus();
            })

            $('#dest').on('click', function(e) {
                    var val_dest = $('#dest').val();                  
                        $('#type_skid').attr('disabled', false);
                        $('#type_skid').focus();
            })

      
            $('#type_skid').on('keypress', function(e) {
                    var val_typeskid = $('#type_skid').val();
                    if (val_typeskid != '') {                  
                     $('#print-skid').attr('disabled', false);
                    
                    }
                   
             });

     



     // START SCAN-OUT SKID
        $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_scan_nik = $('#scan_nik').val();
                    if (val_scan_nik != '') {
                     
                        $('#qr_skid').attr('disabled', false);
                        $('#qr_skid').focus();
                    }
                }
            })
      

        $('#qr_skid').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_qrskid = $('#qr_skid').val();
                    if (val_qrskid != '') {
                     
                        $('#skid_height').attr('disabled', false);
                        $('#skid_height').focus();
                    }
                }
            })

             // START SCAN-OUT SKID
        $('#skid_height').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_skid_height = $('#skid_height').val();                     
                        $('#kit_label').attr('disabled', false);
                        $('#kit_label').focus();
                }
            })

                   // START SCAN-OUT SKID
        $('#kit_label').on('keypress', function(e) {
                if (e.which == 13) {

                    let scan_nik        = $('#scan_nik').val();
                    let qr_skid          = $('#qr_skid').val();
                    let skid_height     = $('#skid_height').val();
                    let kit_label       = $('#kit_label').val();


                    $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ url('/finishgood/viewSkid/scanout_skid/') }}",
                            data: {
                                scan_nik : scan_nik,
                                qr_skid : qr_skid,
                                skid_height: skid_height,
                                kit_label: kit_label,
                                _token: '{{ csrf_token() }}'
                            },
                       
                            success: function(response) {                  
                                console.log(response)
                                
                                        if (response.success) {
                                            var audio   = document.getElementById('audio');
                                            var source  = document.getElementById('audioSource');
                                            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");

                                        swal.fire({
                                            icon: 'success',
                                            title: response.message,

                                            timer: 5000,
                                            showConfirmButton: true,

                                        })
                                        } 
                                        else {
                                            swal.fire({
                                            icon: 'warning',
                                            title: response.message
                                        })  
                                        }

                              var data = ""                          
                              $.each(response.data, function(key, value) {

                                  data = data + "<tr>"
                                    //   if (value.tot_scan == 0 && value.balance_issue == 0) {
                                    //       data = data + "<tr class=table-light>";
                                    //   }
                                    //   if (value.tot_scan != 0 && value.balance_issue != 0) {
                                    //       data = data + "<tr class=table-warning>";
                                    //   }
                                    //   if (value.tot_scan == value.demand && value.balance_issue == 0) {
                                    //       data = data + "<tr class=table-success>";
                                    //   }

                                      data = data + "<td>" + value.id + "</td>"
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
                              $('#view-scanout').html(data);
                            }
                        })
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

    function printMaster(){
            let qr_skid               = $('#qr_skid').val();

            window.location.assign("{{ url('/finishgood/viewSkid/printMaster') }}" + "?qr_skid=" + qr_skid   )
    }


       
    </script>
@endsection
