@extends('layouts.main')



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
                            Scan In Assy Menu
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

                                        </div>
                                    </div>
                                </div>
                            </div>
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


            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {
                     
                        $('#kit_label').attr('disabled', false);
                        $('#kit_label').focus();
                    
                    }
                }
            })





            //STEP 2. SCAN LABEL MC 
            $('#kit_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {
                    let scan_nik        = $('#scan_nik').val();
                    let val_kitLabel    = $('#kit_label').val();
                    let scan_kitLabel   = val_kitLabel.substr(0, 11); //get PARTNO KIT
                    let getPO           = val_kitLabel.split(":");
      	            let qty_kit         = getPO[2];// GET PO KIT

                    // if(scan_mcLabel.search(scan_kitLabel)>= 0 ){
                    //     console.log(qty_kit)
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ url('/repacking/scanassy/input_assy/') }}",
                            data: {
                                scan_nik : scan_nik,
                              
                                kit_label: val_kitLabel,
                                _token: '{{ csrf_token() }}'
                            },
                       
                            success: function(response) {                  
                                console.log(response)
                                        if (response.success) {
                                            var audio   = document.getElementById('audio');
                                            var source  = document.getElementById('audioSource');
                                            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                            // document.getElementById("result_OK").innerHTML = "OKE";
                                            // document.getElementById("result_OK").style.display = "block";
                                            // document.getElementById("result_NG").style.display = "none";           
                                            // audio.load();
                                            // audio.play();


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

                            }
                        })
                    // }



                    // else{

                    //     alert('part not same')
                    //     $.ajax({
                    //         success : function(data){
                    //             var audio = document.getElementById('audio');
                    //             var source = document.getElementById('audioSource');
                    //             var audio = new Audio("{{asset('')}}storage/sound/WRONG.mp3");
                    //             document.getElementById("result_NG").innerHTML = "NG";
                    //             document.getElementById("result_NG").style.display = "block";
                    //             document.getElementById("result_OK").style.display = "none";
                    //             audio.load()
                    //             audio.play();  
                    //     }

                    //  })

                    // }
                }
            })

            // END SCAN IN KIT LABEL
        });
    </script>
@endsection
