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
                            <div class="card border shadow-lg">
                                <div class="collapse " id="scan-collapse">
                                    <div class="justify-content-center mt-3 ml-3 mr-3 ">
    
                                        <div class="row row-cards col-12">
                                            <div class="mb-3 col-sm-5 col-5 d-flex justify-content-end">          
                                                <input style="font-size:20px"
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary"
                                                    type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                    placeholder="NIK" autofocus>
                                                    <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                    type="text" name="lenght" value="" id="lenght"
                                                    placeholder="Lenght" disabled>
                                                 
                                                    <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                    type="text" name="widht" value="" id="widht"
                                                    placeholder="Widht" disabled>
                                                 
                                                    <input
                                                    class="form-control form-control-lg  mb-2 text-center border border-secondary "
                                                    type="text" name="height" value="" id="height"
                                                    placeholder="Height" disabled>
                                                    <input
                                                        class="form-control form-control-lg mb-2 text-center border border-secondary  "
                                                        type="text" name="gw" value="" id="gw"
                                                        placeholder="GW" disabled>
                                           </div>
                                           <div class="mb-3 col-sm-7 col-7">
                                                <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                    type="text" name="mc_label" value="" id="mc_label"
                                                    placeholder="SCAN MC LABEL" disabled>
                                                <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                    type="text" name="kit_label" value="" id="kit_label"
                                                    placeholder="SCAN KIT LABEL" disabled>
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
            
                                                        <tbody id="scanin-view">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                                <br>
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
                         $('#lenght').attr('disabled', false);
                        $('#widht').attr('disabled', false);
                        $('#height').attr('disabled', false);
                        $('#gw').attr('disabled', false);
                    $('#kit_label').focus();
                }
            });


            //STEP 2. SCAN LABEL KIT 
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

                    let lenght = $('#lenght').val();
                    let widht = $('#widht').val();
                    let height = $('#height').val();
                    let gw = $('#gw').val();

                    if(scan_mcLabel.search(scan_kitLabel)>= 0 ){
                        console.log(qty_kit)
                      
                        // alert('Result Oke')

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ url('/repacking/scanIn/inputData/') }}",
                            data: {
                                scan_nik : scan_nik,
                                mc_label : val_mcLabel,
                                lenght : lenght,
                                widht: widht,
                                height : height,
                                gw : gw,                         
                                kit_label: val_kitLabel,
                                _token: '{{ csrf_token() }}'
                            },
                       
                            success: function(response) {                  
                                console.log(response)
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
                                    $('#scanin-view').html(data);


                                        if (response.success) {
                                            var audio = document.getElementById('audio');
                                            var source = document.getElementById('audioSource');
                                            var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                            audio.load()
                                            audio.play();
                                        
                                                swal.fire({
                                                    icon: 'success',
                                                    title: response.message,
                                                    showConfirmButton :false,
                                                    timer: 200,
                                                

                                                })
                                        } 
                                        else {
                                            swal.fire({
                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                        })  
                                            let warningMessage = response.message;
                                            console.log("warning",response.message);
                                            console.log("message",warningMessage.indexOf('DOUBLE'))
                                            console.log("message",warningMessage.indexOf('OVER'))
                                            console.log("message",warningMessage.indexOf('FINISH'))
                                                if(warningMessage.indexOf('DOUBLE') == 0){
                                                    Swal.fire({
                                                    
                                                        icon: 'warning',
                                                        title: response.message,
                                                        showConfirmButton :false,
                                                        timer:200
                                                    

                                                    })
                                                
                                                    
                                                    var audio = document.getElementById('audio');
                                                                var source = document.getElementById('audioSource');
                                                                var audio = new Audio("{{asset('')}}storage/sound/double_scan.mp3");
                                                                audio.load();
                                                                audio.play();
                                                                return;
                                                            
                                            
                                                }

                                                if(warningMessage.indexOf('OVER') == 0){
                                                        Swal.fire({

                                                            icon: 'warning',
                                                            title: response.message,
                                                            showConfirmButton :false,
                                                            timer:300


                                                        })


                                                                    var audio = document.getElementById('audio');
                                                                    var source = document.getElementById('audioSource');
                                                                    var audio = new Audio("{{asset('')}}storage/sound/over_demand.mp3");
                                                                    audio.load();
                                                                    audio.play();


                                                        return;
                                                }


                                                if(warningMessage.indexOf('FINISH') == 0){
                                                        Swal.fire({

                                                            icon: 'warning',
                                                            title: response.message,
                                                            showConfirmButton :false,
                                                            timer:300


                                                        })


                                                                    var audio = document.getElementById('audio');
                                                                    var source = document.getElementById('audioSource');
                                                                    var audio = new Audio("{{asset('')}}storage/sound/scan_complete.mp3");
                                                                    audio.load();
                                                                    audio.play();


                                                        return;
                                                }



                                        }

                            }
                        })
                    }
                    else{

                        Swal.fire({

                            icon: 'error',
                            title: "WRONG PART",
                            showConfirmButton :false,
                            timer:400


                            })

                        var audio = document.getElementById('audio');
                            var source = document.getElementById('audioSource');
                            var audio = new Audio("{{asset('')}}storage/sound/wrong_part.mp3");
                            // document.getElementById("result_NG").innerHTML = "NG";
                            // document.getElementById("result_NG").style.display = "block";
                            // document.getElementById("result_OK").style.display = "none";
                            audio.load()
                            audio.play();

                    }
               



                    $('#mc_label').val("");
                    $('#kit_label').val("");
                    $('#mc_label').focus();
                }
            })

            // END SCAN IN KIT LABEL
           






        });
    </script>
@endsection
