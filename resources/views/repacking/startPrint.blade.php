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
                            Scan In Menu
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
                        <div class="card rounded-1 col-12 mb-2">
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                    <div class="row row-cards col-12">
                                        <div class="mb-3 col-sm-12 col-12">
                                            <input style="font-size:20px"
                                                class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                placeholder="SCAN NIK HERE" autofocus>
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                type="text" name="scan_label" value="" id="scan_label"
                                                placeholder="SCAN MC LABEL" disabled>                                          
                                        </div>                                      
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mb-3 mr-6">
                                        <button class="btn btn-info"
                                            onclick="document.getElementById('scan_label').value = ''">clear</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
            </div>

            <div class="container-xl mt-1 ">
                <div class="row row-deck row-cards ">
                    <div class="col-12 ">
                        <div class="card rounded-1 col-12 mb-2">
                            <div class="col-12 mt-3 mb-3 ">
                                <a style="font-size:20px" class="btn btn-primary col-12" data-bs-toggle="collapse" href="#scan-collapse"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    --- START SCAN---  
                                </a>
                            </div> 
                            <div class="collapsed-flex justify-content-right " id="scan-collapse">                     
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                    <div class="row row-cards col-12">
                                        <div class="mb-3 col-sm-7 col-7">
                                            <input style="font-size:20px"
                                                class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                placeholder="SCAN NIK HERE" autofocus>
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                type="text" name="parlist_no" value="" id="partlist_no"
                                                placeholder="SCAN MC LABEL" disabled>
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                type="text" name="scan_label" value="" id="scan_label"
                                                placeholder="SCAN KIT LABEL" disabled>
                                        </div>

                                        <div class="mb-3 col-sm-5 col-5 d-flex justify-content-end">
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                type="text" name="scan_label" value="" id="scan_label"
                                                placeholder="Lenght">
                                        
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                type="text" name="scan_label" value="" id="scan_label"
                                                placeholder="Widht">
                                         
                                            <input
                                                class="form-control form-control-lg  mb-2 text-center border border-secondary "
                                                type="text" name="scan_label" value="" id="scan_label"
                                                placeholder="Height">
                                            <input
                                                class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                type="text" name="scan_label" value="" id="scan_label"
                                                placeholder="GW">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mb-3 mr-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
         
            @if (Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
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
            // ======================== PRINT KIT=================================
            $("#scan_nik").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            $("#scan_label").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            // =========


            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {
                    
                        $('#scan_label').attr('disabled', false);
                        $('#scan_label').focus();
                    }
                }
            })

            //STEP 2. SCAN LABEL MC 
            $('#scan_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {

                    // var parlistno = $('#partlist_no').val();
                    var scan_nik = $('#scan_nik').val();
                    var scan_label = $('#scan_label').val();

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/repacking/printkit/') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                            data: {
                                scan_nik:scan_nik,
                                scan_label: scan_label
                            },
                        success: function(response) {
                            console.log(response)                          
                        }

                        })
                        }
                    });
            // ========================END SCAN  IN PROCESSS================================


        });
    </script>
@endsection
