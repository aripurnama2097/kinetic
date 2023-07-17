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
                            Page Print
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
                                <h2 style="font-size:30px"class="text-dark ">--PRINT CATEGORY-</h2>
                            </div>

                            <div class="btn-group mb-3" role="group">
                                <div class="col-4  ">
                                    <a class="btn btn-primary   col-12" data-bs-toggle="collapse" href="#assy"
                                        role="button" aria-expanded="false" aria-controls="assy">
                                        <i class="ti ti-printer"></i>
                                        ASSY PRINT
                                    </a>
                                </div>
                                <div class="col-4  ">
                                    <a class="btn btn-primary col-12" data-bs-toggle="collapse" href="#original"
                                    role="button" aria-expanded="false" aria-controls="original">
                                        <i class="ti ti-printer"></i>
                                        ORIGINAL PRINT
                                    </a>
                                </div>
                                <div class="col-4  ">
                                    <a class="btn btn-success col-12 text-white" data-bs-toggle="collapse" href="#combine"
                                    role="button" aria-expanded="false" aria-controls="combine">
                                        <i class="ti ti-printer"></i>COMBINE PRINT
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif

                        <div class="collapse mt-4" id="original">
                            <div class="col-12 ">
                                <div class="card rounded-1 col-12 mb-2">
                                    <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                        <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                            <i class="ti ti-printer"></i> </a>
                                            <a class="btn btn-primary mb-2" href="{{ url('repacking/scanIn') }}"> --Scan In--  </a>
                                            <a class="btn btn-danger mb-2" href="{{ url('repacking/cancel') }}"> --Cancelation-- 
                                                <i class="ti ti-cancel"></i> </a>
                                            <a class="btn btn-success mb-2" href="{{ url('repacking') }}"> Refresh <i
                                                    class="ti ti-refresh"></i> </a>
                                            <h1 class="text-dark text-center"> Print Label KIT</h1>
                                            <div class="row row-cards col-12 mb-4">
                                                <div class="mb-3 col-sm-12 col-12">
                                                    <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                    placeholder="SCAN NIK HERE" >
                                                    <input
                                                        class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                        type="text" name="scan_label" value="" id="scan_label"
                                                        placeholder="SCAN MC LABEL" disabled>                                          
                                                </div>                                      
                                            </div>
                                           
                                        </div>
                                </div>
                            </div>
                        </div>

                        {{-- COMBINE SCAN IN --}}
                        <div class="collapse mt-4" id="combine">
                            <div class="col-12 ">
                                <div class="card rounded-1 col-12 mb-2">
                                    <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                        <h1 class="text-dark text-center">Combine Category</h1>
                                        <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                            <i class="ti ti-printer"></i> </a>
                                            <a class="btn btn-light mb-2" href="{{ url('repacking/scanCombine') }}"> --Scan Combine--  </a>
                                            <a class="btn btn-danger mb-2" href="{{ url('repacking/scanCombine') }}"> --Cancelation-- 
                                                <i class="ti ti-cancel"></i> </a>
                                            <a class="btn btn-success mb-2" href="{{ url('repacking') }}"> Refresh <i
                                                    class="ti ti-refresh"></i> </a>
                                            {{-- <h1 class="text-dark text-center"> Print Label KIT</h1> --}}
                                            <div class="row row-cards col-12 mb-4">
                                                <div class="mb-3 col-sm-12 col-12">
                                                    <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                                    placeholder="SCAN NIK HERE" >
                                                    <input
                                                        class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                        type="text" name="scan_label" value="" id="scan_label"
                                                        placeholder="SCAN MC LABEL" disabled>                                          
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

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>

    <script type="text/javascript">
    
        $(document).ready(function() {
            const spinner = document.querySelector('#spinner');

          $('#repacking-org').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );

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

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/repacking/printlbl_kit/') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            scan_label: scan_label
                        },
                        success: function(response) {
                            alert('succes print label')
                            console.log(response)

                            // if (response.success) {
                            // swal.fire({
                            //                 icon: 'success',
                            //                 title: response.message,

                            //                 timer: 5000,
                            //                 showConfirmButton: true,

                            //             })
                            //             } 
                            // else {
                            //                 swal.fire({
                            //                 icon: 'warning',
                            //                 title: response.message
                            //             })  
                            // }
                       
                        }
                    });
                }
            });


        });
    </script>
@endsection
