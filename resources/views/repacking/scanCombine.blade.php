@extends('layouts.main')

{{-- @section('css_style')
    <style>
        thead {
            background-color: #1c87c9;
            color: #ffffff;
        }
    </style>
@endsection --}}

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-fluid">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Scan Combine
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
                        <div class="card rounded-1 col-12 mb-2">
                            <div class="col-12 mt-3 mb-3 ">
                                <a style="font-size:20px" class="btn btn-primary col-12" data-bs-toggle="collapse" href="#scan-collapse"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    --- START SCAN ---  
                                </a>
                            </div>

                            {{-- DATA SCAN IN --}}
                            <div class="collapse " id="scan-collapse">
                                <div class="justify-content-center mt-3 ml-3 mr-3 mb-3">

                                    <div class="row row-cards col-12">
                                        <div class="mb-3 col-sm-7 col-7">
                                            <input style="font-size:20px"
                                                class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                placeholder="SCAN NIK HERE" autofocus>
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                type="text" name="mc_label" value="" id="mc_label"
                                                placeholder="SCAN MC LABEL" disabled>
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                type="text" name="kit_label" value="" id="kit_label"
                                                placeholder="SCAN KIT LABEL" disabled>
                                        </div>

                                        <div class="mb-3 col-sm-5 col-5 d-flex justify-content-end">
                                            {{-- <label style="font-size:20px"  class="text-bold;"> Gross Weight</label>                                      --}}
                                            {{-- <label style="font-size:20px"  class="text-bold;"> Lenght</label>           --}}
                                            <input
                                            class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                            type="text" name="lenght" value="" id="lenght"
                                            placeholder="Lenght">
                                            {{-- <label style="font-size:20px"  class="text-bold;"> Widht</label>     --}}
                                            <input
                                            class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                            type="text" name="widht" value="" id="widht"
                                            placeholder="Widht">
                                            {{-- <label style="font-size:20px"  class="text-bold;"> Height</label>     --}}
                                            <input
                                            class="form-control form-control-lg  mb-2 text-center border border-secondary "
                                            type="text" name="height" value="" id="height"
                                            placeholder="Height">
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                type="text" name="gw" value="" id="gw"
                                                placeholder="GW">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end mb-3 mr-6">
                                        <button class="btn btn-info"
                                            onclick="document.getElementById('scan_label').value = ''">submit</button>
                                     
                                    </div>
                                   
                                    <div class="table-responsive">
                                        <table style="width:100%"
                                        class="text-nowrap  table border-bordered border border-primary shadow-sm">
                                        <thead class="thead-dark">
                                              <tr>
                                                {{-- <th class="text-center mb-1" style="font-size: 15px;">QR code</th> --}}
                                                <th class="text-center mb-1"style="font-size: 15px;">Cust PO</th>
                                                <th class="text-center mb-1"style="font-size: 15px;">Item No</th>
                                                <th class="text-center mb-1"style="font-size: 15px;">Item Description</th>
                                                <th class="text-center mb-1"style="font-size: 15px;">Shelf No</th>
                                                <th class="text-center mb-1"style="font-size: 15px;">Qty</th>
                                      
                                              </tr>
                                            </thead>
                                            <tbody id="scan-in">
                                            </tbody>
                                        </table>
                                    </div>
                                    <a  id="print-master" href="{{url('repacking/scanCombine/printMaster')}}"class="btn btn-success text-white  col-12 mb-3" disabled><i class="ti ti-print"></i>
                                        Print Master Label
                                    </a>
                                </div>
                                <div class="col-2">
                                    <a  href="{{url('repacking/')}}"class="btn btn-warning text-white  mb-3"><i class="ti ti-back"></i>Back
                                    </a>
                                </div>
                               
                            </div>
                     
                            {{-- <div class="col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">RESULT SCAN</h3>
                                    </div>
                                    <div class="card-table table-responsive">
                                        <table class="table table-vcenter" id="example">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th style="font-size: 10px;">Model</th>
                                                    <th style="font-size: 10px;">Prod No</th>
                                                    <th style="font-size: 10px;">JKEI Po Date</th>
                                                    <th style="font-size: 10px;">Van Date</th>
                                                    <th style="font-size: 10px;">Order Item</th>
                                                    <th style="font-size: 10px;">Cust PO</th>
                                                    <th style="font-size: 10px;">Part Number</th>
                                                    <th style="font-size: 10px;">Part Name</th>
                                                    <th style="font-size: 10px;">Demand</th>
                                                    <th style="font-size: 10px;">Shelf No</th>
                                                    <th style="font-size: 10px;">Qty Issue</th>

                                                    <th style="font-size: 10px;">Print</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <a href="{{url('/repacking')}} " class="btn btn-warning mb-3" ><i class="ti ti-back"></i>Back 
                                </a>
                               
                           </div> --}}
                    </div>
                    <br>

                    <br>
                </div>
            </div>

            <br>
            @if (Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
 

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
           //  ===============SCAN  IN PROCESSS=================================
           $("#scan_nik").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            $("#mc_label").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            $("#kit_label").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            // =========

            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {
                        $('#mc_label').attr('disabled', false);
                        $('#kit_label').attr('disabled', false);
                        $('#mc_label').focus();
                    }
                }
            })


            $('#mc_label').on('keypress', function(e){
                if(e.which == 13) {
                    let val_mcLabel      = $('#mc_label').val()
                    $('#kit_label').focus();
                }
            });


            //STEP 2. SCAN LABEL MC 
            $('#kit_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {
                    let scan_nik        = $('#scan_nik').val();
                    let val_mcLabel     = $('#mc_label').val();
                    let scan_mcLabel    = val_mcLabel.substr(0, 11); // get PARTNO
                    let qty_mcLabel     = val_mcLabel.substr(24, 26); // get QTY MC

                    let val_kitLabel    = $('#kit_label').val();
                    let scan_kitLabel   = val_kitLabel.substr(0, 11); //get PARTNO KIT
                    let getPO           = val_kitLabel.split(":");
      	            let qty_kit         = getPO[2];// GET PO KIT
                    if (val_kitLabel != '') {                  
                     $('#print-master').attr('disabled', false);
                    
                    }
                    if(scan_mcLabel.search(scan_kitLabel)>= 0 ){
                        console.log(qty_kit)
                      
                        // alert('Result Oke')

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ url('/repacking/scanCombine/inputCombine/') }}",
                            data: {
                                scan_nik : scan_nik,
                                mc_label : val_mcLabel,
                                kit_label: val_kitLabel,
                            
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

                                            // timer: 5000,
                                            // showConfirmButton: true,

                                        })
                                        } 
                                        else {
                                            swal.fire({
                                            icon: 'warning',
                                            title: response.message
                                        })  
                                        }

                                        var data=""
                                        $.each(response.data, function(key, value) {
                                        data = data + "<tr>"                               
                                        data = data + "<td class=text-center>" + value.custpo + "</td>"
                                        data = data + "<td class=text-center>" + value.partno + "</td>"
                                        data = data + "<td class=text-center>" + value.partname + "</td>"
                                        data = data + "<td class=text-center>" + value.shelfno + "</td>"
                                        data = data + "<td class=text-center>" + value.act_receive + "</td>"
                                       
                                        data = data + "</tr>"
                                        })
                                        $('#scan-in').html(data);

                                        

                            }
                        })
                    }



                    else{

                        alert('part not same')
                        $.ajax({
                            success : function(data){
                                var audio = document.getElementById('audio');
                                var source = document.getElementById('audioSource');
                                var audio = new Audio("{{asset('')}}storage/sound/WRONG.mp3");
                                document.getElementById("result_NG").innerHTML = "NG";
                                document.getElementById("result_NG").style.display = "block";
                                document.getElementById("result_OK").style.display = "none";
                                audio.load()
                                audio.play();  
                        }

                     })

                    }
                }
            })

            // END SCAN IN KIT LABEL


        });

        //           

        // if (response.success) {
        // swal.fire({
        //     icon: 'success',
        //     title: "Scan Part Oke",
        //     text: response.data,
        //     timer: 5000,
        //     showConfirmButton: true,

        //   })
        // }
        // else  {
        // swal.fire({
        //     icon: 'error',
        //     title: "Double Scan",
        //     text: response.data,
        //     timer: 5000,
        //     showConfirmButton: true,

        //   })
        // }
    </script>
@endsection
