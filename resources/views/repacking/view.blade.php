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
                            Page Scan
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

            {{-- <div class="container-xl mt-1 "> --}}
            <div class="row row-deck row-cards ">
                <div class="col-12 ">
                    <div class="card rounded-1 col-12 ">
                        <div class="card-header text-center justify-content-center">
                            <h2 style="font-size:30px"class="text-dark ">--PART CATEGORY-</h2>
                        </div>
                       
                        <div class="btn-group mb-3" role="group">
                            <div class="col-4  ">
                                <a class="btn btn-primary   col-12 text-white" data-bs-toggle="collapse" id="btn-assy" role="button"
                                    aria-expanded="false" aria-controls="assy">
                                    <i class="ti ti-box-seam"></i>
                                    ASSY PART
                                </a>
                            </div>
                            <div class="col-4  ">
                                <a class="btn btn-primary col-12 text-white" data-bs-toggle="collapse" id="btn-ori" role="button"
                                    aria-expanded="false" aria-controls="original">
                                    <i class="ti ti-box-seam"></i>
                                    ORIGINAL PART
                                </a>
                            </div>
                            <div class="col-4  ">
                                <a class="btn btn-success col-12 text-white" data-bs-toggle="collapse" id="btn-combine"
                                    role="button" aria-expanded="false" aria-controls="combine">
                                    <i class="ti ti-box-seam"></i>COMBINE PART
                                </a>
                            </div>
                        </div>

                     

                        
                        
                    </div>
                </div>

                <br>
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif

           
           
                {{-- ASSY PROCESS --}}
            <div class="collapse mt-4" id="assy">
                    <div class="col-12 ">
                        <div class="card rounded-1 col-12 mb-2">
                            <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                <h1 class="text-dark text-center">Assy Part</h1>
                            <div class="btn-group">
                                <a class="btn btn-success  text-white mb-3" data-bs-toggle="collapse" id="btn-print-input"
                                    role="button" aria-expanded="false" aria-controls="print-assyInput">
                                    <i class="ti ti-printer"></i>PRINT ASSY INPUT
                                </a>
                                <a class="btn btn-light  text-dark mb-3" data-bs-toggle="collapse" id="btn-print-scan"
                                role="button" aria-expanded="false" aria-controls="print-assyScan">
                                <i class="ti ti-printer"></i>PRINT ASSY SCAN
                               </a>

                              
                                </div>
                                <div class="btn-group float-lg-right">
                                <a class="btn btn-primary mb-3 float-md-right" href="{{ url('repacking/scan_assy') }}"> --Scan In Assy--
                                </a>
                                <a class="btn btn-danger mb-3  float-md-right" href="{{ url('repacking/cancel') }}"> Cancelation 
                                    <i class="ti ti-circle-x"></i>
                                </a>
                                </div>
                                {{-- PRINT ASSY INPUT --}}
                                <div class="collapse mt-4" id="print-assyInput">
                                    <div class="table-responsive  rounded-1 shadow-sm">
                                        <h1 class="text-dark text-center"> Assy Category</h1>
                                        <table style="width:100%" id="example"
                                            class="table table-striped border border-primary shadow-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th style="font-size: 10px;">Model</th>
                                                    <th style="font-size: 10px;">IdNumber</th>
                                                    <th style="font-size: 10px;">Lot No</th>
                                                    <th style="font-size: 10px;">JKN PO</th>
                                                    <th style="font-size: 10px;">QTY</th>
                                                    <th style="font-size: 10px;">Print</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($assy as $key => $value)
                                                    <tr>
                                                    <td style="font-size: 12px;">{{ $value->model }} </td>
                                                    <td style="font-size: 12px;">{{ $value->idnumber}} </td>
                                                    <td style="font-size: 12px;">{{ $value->lotno }} </td>
                                                    <td style="font-size: 12px;">{{ $value->jknpo }} </td>
                                                    <td style="font-size: 12px;"> {{ $value->qty_input }}</td> 
                                                    </td>
                                                    <td style="font-size: 12px;">
                                                        <a class="btn btn-primary btn-sm text-white" data-toggle="modal"
                                                            data-target="#printAssy_{{ $value->id }}">Print KIT</a>
                                                        <div class="modal modal-blur fade" id="printAssy_{{ $value->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Print Label KIT Assy</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <form
                                                                            action="{{ url('repacking/printassy/' . $value->id) }}"
                                                                            method="POST">

                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label class="form-label">PIC</label>
                                                                                <input type="text" name="pic_print"
                                                                                    id="pic_print" class="form-control"
                                                                                    name="example-text-input"
                                                                                    placeholder="PIC">
                                                                            </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-light link-warning"
                                                                            data-bs-dismiss="modal">
                                                                            Cancel
                                                                        </button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary ms-auto">
                                                                            Print
                                                                        </button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>                      
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                            <a class="btn btn-primary mb-2" href="{{ url('/repacking') }}"> Back <i
                                                    class="ti ti-back"></i> </a>
                                    </div>
                                </div>
                                {{-- PRINT ASSY SCAN --}}
                                <div class="collapse mt-4" id="print-assyScan">
                                    <div class="col-12 ">
                                        <div class="card rounded-1 col-12 mb-2">
                                            <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                            <h1 class="text-dark text-center"> Print Label KIT</h1>
                                            <div class="row row-cards col-12 mb-4">
                                                <div class="mb-3 col-sm-12 col-12">
                                                    <input style="font-size:20px"
                                                        class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                        type="text" name="pic" value="" id="pic" maxlength="8"
                                                        placeholder="SCAN NIK HERE">
                                                    <input class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                        type="text" name="assy_label" value="" id="assy_label"
                                                        placeholder="SCAN ASSY LABEL" disabled>
                                                </div>
                                            </div>
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>


              {{-- ORIGINAL SINGLE PROCESS --}}
            <div class="collapse mt-4" id="original">
                    <div class="col-12 ">
                        <div class="card rounded-1 col-12 mb-2">
                            <h1 class="text-dark text-center">Original Part</h1>
                            <div class="justify-content-center mt-3 ml-3 mr-3 ">
                              
                            <a class="btn btn-primary mb-2" href="{{ url('repacking/scanIn') }}"> --Scan In-- </a>
                            <a class="btn btn-danger mb-2" href="{{ url('repacking/cancel') }}"> --Cancelation--
                                <i class="ti ti-cancel"></i> </a>
                            <a class="btn btn-success mb-2" href="{{ url('repacking') }}"> Refresh <i
                                    class="ti ti-refresh"></i> </a>
                        

                            

                        </div>
                    </div>
                </div>
            </div>

            {{-- COMBINE PROCESS --}}
            <div class="collapse mt-4" id="combine">
                <div class="col-12 ">
                    <div class="card rounded-1 col-12 mb-2">
                        <div class="justify-content-center mt-3 ml-3 mr-3 ">
                            <h1 class="text-dark text-center">Combine Part</h1>
                          
                            <a class="btn btn-light mb-2" href="{{ url('repacking/scanCombine') }}"> --Scan Combine--
                            </a>
                            <a class="btn btn-danger mb-2" href="{{ url('repacking/cancel') }}"> --Cancelation--
                                <i class="ti ti-cancel"></i> </a>
                            <a class="btn btn-success mb-2" href="{{ url('repacking') }}"> Refresh <i
                                    class="ti ti-refresh"></i> </a>
                            {{-- <h1 class="text-dark text-center"> Print Label KIT</h1> --}}
                            {{-- <div class="row row-cards col-12 mb-4">
                                <div class="mb-3 col-sm-12 col-12">
                                    <input style="font-size:20px"
                                        class="form-control form-control-xs mb-2 text-center border border-secondary "
                                        type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                        placeholder="SCAN NIK HERE">
                                    <input class="form-control form-control-lg mb-2 text-center border border-secondary "
                                        type="text" name="scan_label" value="" id="scan_label"
                                        placeholder="SCAN MC LABEL" disabled>
                                </div>
                            </div> --}}

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

            
            $('#btn-assy').on('click', function(){
                $('#original').hide();
                $('#combine').hide();
                $('#print_label').hide();
                $('#assy').show();
            })

            $('#btn-ori').on('click', function(){
                $('#assy').hide();
                $('#combine').hide();
                $('#print_label').hide();
                $('#original').show();
            })

            $('#btn-combine').on('click', function(){
                $('#assy').hide();
                $('#original').hide();
                $('#print_label').hide();
                $('#combine').show();
            })

            $('#btn-print-label').on('click', function(){
                $('#assy').hide();
                $('#original').hide();
                $('#combine').hide();
                $('#print_label').show();
            })

            $('#btn-print-input').on('click', function(){
                $('#print-assyScan').hide();
                $('#print-assyInput').show();
            })

            $('#btn-print-scan').on('click', function(){
                $('#print-assyInput').hide();
                $('#print-assyScan').show();
            })

          


            const spinner = document.querySelector('#spinner');

            $('#repacking-org').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                    'csvHtml5'
                ]
            });

            $('#print_kitOrg').on('submit', function(e) {
                e.preventDefault();

                var scan_nik = $('#scan_nik').val();


                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {
                        scan_nik: scan_nik
                    },
                    url: "{{ url('repacking/printOriginal/{id}/') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // window.location.replace(response.redirect);
                        console.log(response);




                    },



                    failure: function(form, action) {
                        Ext.Msg.show({
                            title: 'OOPS, AN ERROR JUST HAPPEN !',
                            icons: Ext.Msg.ERROR,
                            msg: action.result.msg,
                            buttons: Ext.Msg.OK
                        });
                    }
                })


            });



              //START PRINT LABEL ORIGINAL
            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {

                        $('#scan_label').attr('disabled', false);
                        $('#scan_label').focus();
                    }
                }
            })


            $('#scan_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'info',
                        title: 'Process Print'
                    })



                    var scan_label = $('#scan_label').val();
                    window.location.assign("{{ url('/repacking/printlbl_kit/') }}" + "?scan_label=" +
                        scan_label)
                    $('#scan_label').val("");
                    $('#scan_label').focus();
                }
            });
             //END PRINT LABEL ORIGINAL


            //START PRINT LABEL COMBINE
            $('#pic').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_pic = $('#pic').val();
                    if (val_pic != '') {

                        $('#assy_label').attr('disabled', false);
                        $('#assy_label').focus();
                    }
                }
            })

            $('#assy_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'info',
                        title: 'Process Print'
                    })



                    var assy_label = $('#assy_label').val();
                    window.location.assign("{{ url('/repacking/printlbl_assy/') }}" + "?assy_label=" +
                        assy_label)
                    $('#assy_label').val("");
                    $('#assy_label').focus();
                }
            });
             //END PRINT LABEL ASSY

            //START PRINT LABEL COMBINE
            $('#scan_pic').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_pic').val();
                    if (val_nik != '') {

                        $('#scan_label_mc').attr('disabled', false);
                        $('#scan_label_mc').focus();
                    }
                }
            })


           
            $('#scan_label_mc').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'info',
                        title: 'Process Print'
                    })



                    var scan_label_mc = $('#scan_label_mc').val();
                    window.location.assign("{{ url('/repacking/printlbl_kit_combine/') }}" + "?scan_label_mc=" +
                        scan_label_mc)
                    $('#scan_label_mc').val("");
                    $('#scan_label_mc').focus();
                }
            });
             //END PRINT LABEL COMBINE


        });
    </script>
@endsection
