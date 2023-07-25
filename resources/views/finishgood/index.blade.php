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
                                <h2 style="font-size:30px"class="text-dark ">--PACKING CATEGORY-</h2>
                            </div>

                            <div class="btn-group mb-3" role="group">
                                <div class="col-4  ">
                                    <a class="btn btn-primary   col-12" data-bs-toggle="collapse" href="#box-packing"
                                        role="button" aria-expanded="false" aria-controls="box-packing">
                                        <i class="ti ti-box"></i>
                                        BOX 
                                    </a>
                                </div>
                                <div class="col-4  ">
                                    <a class="btn btn-primary col-12" href="{{url('finishgood/viewSkid')}}">
                                        <i class="ti ti-box"></i>
                                        SKID
                                    </a>
                                </div>
                                <div class="col-4  ">
                                    <a class="btn btn-light col-12 text-dark" href="{{url('finishgood/viewDummy')}} ">
                                        <i class="ti ti-box"></i>
                                        DUMMY SKID
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <br>
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif

                        <div class="collapse mt-4" id="box-packing" hide>
                            <div class="col-12 ">
                                <div class="card rounded-1 col-12 mb-2">
                                    <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                        <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                            <i class="ti ti-printer"></i> </a>
                                        <a class="btn btn-success mb-2" href="{{ url('finishgood') }}"> Refresh <i
                                                class="ti ti-refresh"></i> </a>
                                        {{-- <a class="btn btn-primary mb-2" href="{{ url('repacking/scanIn') }}"> --Scan In--  </a>
                                        <a class="btn btn-light mb-2" href="{{ url('repacking/scanCombine') }}"> --Scan Combine--  </a> --}}
                                        <h1 class="text-dark text-center"> --SCAN OUT BOX--</h1>                
                                        <div class="d-flex justify-content-center">
                                            <div class="row row-cards col-12 mb-4">
                                                <div class="mb-3 col-sm-12 col-12">
                                                    <input style="font-size:20px"
                                                        class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                        type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                        placeholder="SCAN NIK HERE">
                                                    <input style="font-size:20px"
                                                        class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                        type="text" name="packing_no" value="" id="packing_no" maxlength="8"
                                                        placeholder="PACKING NO" disabled>
                                                    <input style="font-size:20px"
                                                        class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                        type="text" name="box_no" value="" id="box_no" maxlength="8"
                                                        placeholder="BOX NO"  disabled>
                                                    <select style="font-size:15px"  class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                        id="prodno" name="prodno" disabled>
                
                                                        @foreach ($prodno as $dd)
                                                            <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input
                                                        class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                        type="text" name="kit_label" value="" id="kit_label"
                                                        placeholder="SCAN KIT LABEL" disabled>    
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-primary col-4 text-center"
                                                            id="print-box" onclick="printBox()" disabled>Print ID</button>                                   
                                                        </div>   
                                                </div>                                      
                                            </div>
                                        </div>
                                            <div class="col-12 d-flex justify-content-end mb-2 mr-6">
                                              
                                            </div>
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

            // START PRINT ID BOX
            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {
                     
                        $('#packing_no').attr('disabled', false);
                        $('#packing_no').focus();
                    }
                }
            })

            $('#packing_no').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_packing_no = $('#packing_no').val();
                    if (val_packing_no != '') {
                     
                        $('#box_no').attr('disabled', false);
                        $('#box_no').focus();
                    }
                }
            })


            $('#box_no').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_box_no = $('#box_no').val();
                    if (val_box_no != '') {
                     
                        $('#prodno').attr('disabled', false);
                        $('#prodno').focus();
                    }
                }
            })


            $('#prodno').on('click', function(e) {
                // if (e.which == 13) {
                    var val_prodno = $('#prodno').val();
                    // if (val_prodno != '') {
                     
                        $('#kit_label').attr('disabled', false);
                        $('#kit_label').focus();
                    // }
                // }
            })


               //STEP 2. SCAN OUT LABEL KIT
               $('#kit_label').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_kitlabel = $('#kit_label').val();
                    if (val_kitlabel != '') {                  
                     $('#print-box').attr('disabled', false);
                    
                    }
                  

                    let scan_nik        = $('#scan_nik').val();
                    let packing_no        = $('#packing_no').val();
                    let box_no        = $('#box_no').val();
                    let prodno        = $('#prodno').val();
                    let kit_label    = $('#kit_label').val();

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ url('/finishgood/scanout_box') }}",
                            data: {
                                scan_nik : scan_nik,
                                packing_no : packing_no,
                                box_no: box_no,
                                prodno: prodno,
                                kit_label:kit_label,
                                _token: '{{ csrf_token() }}'
                            },          
                            success: function(response) {                  
                                console.log(response)
                                 if (response.success) {
                                        //     var audio   = document.getElementById('audio');
                                        //     var source  = document.getElementById('audioSource');
                                        //     var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                        //     // document.getElementById("result_OK").innerHTML = "OKE";
                                        //     // document.getElementById("result_OK").style.display = "block";
                                        //     // document.getElementById("result_NG").style.display = "none";           
                                        //     // audio.load();
                                        //     // audio.play();


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

                                 $('#kit_label').val("");

                            }
                        })
                                
                }
            })

            // END SCAN IN KIT LABEL
        });


        // START PRINT ID BOX
        function printBox(){
            let scan_nik        = $('#scan_nik').val();
                    let packing_no        = $('#packing_no').val();
                    let box_no        = $('#box_no').val();
                    let prodno        = $('#prodno').val();
                    let kit_label    = $('#kit_label').val();
                    window.location.assign(       "{{ url('/finishgood/printID') }}" + "?scan_nik=" + scan_nik + "&packing_no=" + packing_no + "&box_no=" + box_no +"&prodno=" + prodno + "&kit_label=" + kit_label  )
                        // $.ajax({
                        //     type: "get",
                        //     dataType: "json",
                        //     url: "{{ url('/finishgood/printID') }}",
                        //     data: {
                        //         scan_nik : scan_nik,
                        //         packing_no : packing_no,
                        //         box_no: box_no,
                        //         prodno: prodno,
                        //         kit_label:kit_label,
                        //         _token: '{{ csrf_token() }}'
                        //     },          
                        //     success: function(response) {                  
                        //         console.log(response)
                        //         //  if (response.success) {
                                      
                        //         //         swal.fire({
                        //         //             icon: 'success',
                        //         //             title: response.message,

                        //         //             timer: 5000,
                        //         //             showConfirmButton: true,

                        //         //         })
                        //         //     } 
                        //         //     else {
                        //         //             swal.fire({
                        //         //             icon: 'warning',
                        //         //             title: response.message
                        //         //         })  
                        //         //  }

                        //     }
                        // })


        }
    </script>
@endsection
