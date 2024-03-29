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
                            Cancel Scan In Menu
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
                                <a style="font-size:20px" class="btn btn-secondary col-12" data-bs-toggle="collapse" href="#scan-collapse"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    --- START CANCEL ---  
                                </a>
                            </div>

                            {{-- DATA SCAN IN --}}
                            <div class="collapse " id="scan-collapse">
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">

                                    <div class="row row-cards col-12">
                                        <div class="mb-3 col-sm-12 col-12">
                                            <input style="font-size:20px"
                                                class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                placeholder="SCAN NIK HERE" autofocus>
                                        
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                type="text" name="kit_label" value="" id="kit_label"
                                                placeholder="SCAN KIT LABEL" disabled>
                                                <h1 id="msg" class="card-text text-center"></h1>
                                                <h5 id="msg" class="card-text text-success"></h5>                        
                                                <audio id="audio">
                                                    <source id="audioSource" src="{{asset('')}}storage/sound/OK.mp3" type="audio"> 
                                                </audio>                                 
                                                   <div class="d-flex justify-content-center">
                                                        <label class="text-center font-weight-bold text-success" id="result_OK"  style="font-size:50px;"> 
                                                        </label>
                                                        <label class="text-center font-weight-bold text-danger" id="result_NG" style="font-size:50px;"> 
                                                        </label>  
                                                  </div>
                                                <div class="col-2">
                                                    <a  href="{{url('repacking/')}}"class="btn btn-warning text-white  mb-3"><i class="ti ti-back"></i>Back
                                                    </a>
                                                </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-bottom d-flex justify-content-center ">
                                <div class="table-responsive  rounded-1 shadow-sm  mr-5 col-12 shadow-lg ">

                                    <table style="width:100%"
                                        class="text-nowrap  table border-bordered border border-primary shadow-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                {{-- <th style="font-size: 10px;">No</th> --}}
                                                <th style="font-size: 10px;">Cust Code</th>
                                                <th style="font-size: 10px;">Cust Po</th>
                                                <th style="font-size: 10px;">Prod No</th>
                                                <th style="font-size: 10px;">Part Number</th>
                                                <th style="font-size: 10px;">Part Name</th>
                                                <th style="font-size: 10px;">Demand</th>
                                                <th style="font-size: 10px;">Total Scan</th>
                                                <th style="font-size: 10px;">Balance Scan</th>
                                            </tr>
                                        </thead>

                                        <tbody id="scanin-cancel">
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <br>
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
                                <a href="{{url('/repacking')}} " class="btn btn-warning mb-3" ><i class="ti ti-back"></i>Back </a>
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
    {{-- @endsection

@section('script') --}}
    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            $('#partlist').dataTable({
                "paging": true,


            });


            //  ===============SCAN  IN PROCESSS=================================
            $("#scan_nik").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
          
            $("#kit_label").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            // =========

            $('#scan_nik').focus();

            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {
                    
                        $('#kit_label').attr('disabled', false);
                        $('#kit_label').focus();
                    }
                }
            })




            //STEP 2. SCAN LABEL KIT
            $('#kit_label').on('keypress', function(e) {
         
                if (e.which == 13) {
                    let scan_nik        = $('#scan_nik').val();
                    let val_kitLabel    = $('#kit_label').val();
                    let scan_kitLabel   = val_kitLabel.substr(0, 11); //get PARTNO KIT
                    let getPO           = val_kitLabel.split(":");
      	            let qty_kit         = getPO[2];// GET PO KIT


                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ url('/repacking/cancel_scanin/') }}",
                            data: {
                                scan_nik : scan_nik,
                    
                                kit_label: val_kitLabel,
                                _token: '{{ csrf_token() }}'
                            },
                       
                            success: function(response) {                  
                                var data = ""
                                $.each(response.data, function(key, value) {

                                 

                                    data = data + "<tr>"
                                    if (value.act_receive == 0 && value.bal_receive == 0) {
                                        data = data + "<tr class=table-light>";
                                    }
                                    if (value.act_receive != 0 && value.bal_receive != 0) {
                                        data = data + "<tr class=table-warning>";
                                    }
                                    if (value.act_receive == value.demand && value
                                        .bal_receive == 0) {
                                        data = data + "<tr class=table-success>";
                                    }

                                    // data = data + "<td>" + value.id + "</td>"
                                    data = data + "<td>" + value.custcode + "</td>"
                                    data = data + "<td>" + value.custpo + "</td>"
                                    data = data + "<td>" + value.prodno + "</td>"
                                    data = data + "<td>" + value.partno + "</td>"
                                    data = data + "<td>" + value.partname + "</td>"
                                    data = data + "<td>" + value.demand + "</td>"
                                    data = data + "<td>" + value.act_receive+ "</td>"
                                    data = data + "<td>" + value.bal_receive +
                                        "</td>"

                                    data = data + "</tr>"
                                    })
                                    $('#scanin-cancel').html(data);

                                        if (response.success) {
                                            var audio   = document.getElementById('audio');
                                            var source  = document.getElementById('audioSource');
                                            var audio   = new Audio("{{asset('')}}storage/sound/cancel_part.mp3");
                                            audio.load();
                                            audio.play();
                                        
                                        swal.fire({
                                            icon: 'success',
                                            title: response.message,

                                            timer: 300,
                                            showConfirmButton: false,

                                        })
                                        } 
                                        else {
                                            swal.fire({
                                            icon: 'warning',
                                            title: response.message
                                        })  
                                        }

                            }
                        })
                                 $('#kit_label').val("");
                                 $('#kit_label').focus();
                }
            })

            // END SCAN IN KIT LABEL
           






        });
    </script>
@endsection
