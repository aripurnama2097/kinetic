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
                                <h2 style="font-size:30px"class="text-dark ">--PACKING SKID CATEGORY-</h2>
                            </div>

                            <div class="btn-group mb-3" role="group">
                                <div class="col-6  ">
                                    <a class="btn btn-primary   col-12" data-bs-toggle="collapse" href="#skid-packing"
                                        role="button" aria-expanded="false" aria-controls="skid-packing">
                                        <i class="ti ti-box"></i>
                                        Print Skid
                                    </a>
                                </div>
                                <div class="col-6  ">
                                    <a class="btn btn-success col-12" data-bs-toggle="collapse" href="#scan-out"
                                    role="button" aria-expanded="false" aria-controls="scan-out">
                                        <i class="ti ti-box"></i>
                                        Scan Out
                                    </a>
                                </div>
                               
                            </div>
                           
                        </div>
                    </div>

                    <br>
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif

                    <div class="collapsed-flex justify-content-center " id="skid-packing">
                        <div class="col-12 ">
                            <div class="card rounded-1 col-12 mb-2">
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                    <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                        <i class="ti ti-printer"></i> </a>
                                    <a class="btn btn-success mb-2" href="{{ url('finishgood/viewSkid') }}"> Refresh <i
                                            class="ti ti-refresh"></i> </a>
                                    <a class="btn btn-warning mb-2" href="{{ url('finishgood') }}"> Back <i
                                            class="ti ti-back"></i> </a>
                                  
                                    <h1 class="text-dark text-center"> --SKID PRINT--</h1>                
                                    <div class="d-flex justify-content-center">
                                        <div class="row row-cards col-12 mb-4">
                                            <div class="mb-3 col-sm-12 col-12">
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="packing_no" value="" id="packing_no" maxlength="8"
                                                    placeholder="PACKING NO" autofocus>
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="skid_no" value="" id="skid_no" maxlength="8"
                                                    placeholder="SKID NO"  disabled>
                                                <select style="font-size:15px"  class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    id="vandate" name="vandate" disabled>
            
                                                    @foreach ($vandate as $dd)
                                                        <option value="{{ $dd->vandate }}">{{ $dd->vandate }}</option>
                                                    @endforeach
                                                </select>
                                                <select style="font-size:15px"  class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                id="dest" name="dest" disabled>
        
                                                @foreach ($dest as $dd)
                                                    <option value="{{ $dd->dest }}">{{ $dd->dest }}</option>
                                                @endforeach
                                                 </select>
                                               
                                                <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                    type="text" name="type_skid" value="" id="type_skid"
                                                    placeholder="TYPE SKID" disabled>    
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-primary col-4 text-center"
                                                        id="print-skid" onclick="printskid()" disabled>Print SKID</button>                                   
                                                    </div>   
                                            </div>                                      
                                        </div>
                                    </div>
                                        
                                    </div>
                            </div>
                        </div>
                    </div>               
                    
                    <div class="collapsed-flex justify-content-center " id="scan-out">
                        <div class="col-12 ">
                            <div class="card rounded-1 col-12 mb-2">
                                <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                  
                                
                                    <h1 class="text-dark text-center"> --SCAN OUT--</h1>                
                                    <div class="d-flex justify-content-center">
                                        <div class="row row-cards col-12 mb-4">
                                            <div class="mb-3 col-sm-12 col-12">
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="skid_no" value="" id="skid_no" maxlength="8"
                                                    placeholder="SCAN QR SKID" autofocus>
                                                <input
                                                    class="form-control form-control-lg mb-2 text-center border border-secondary "
                                                    type="text" name="skid_height" value="" id="skid_height"
                                                    placeholder="SKID HEIGH" disabled>    
                                                <input style="font-size:20px"
                                                    class="form-control form-control-xs mb-2 text-center border border-secondary "
                                                    type="text" name="kit_label" value="" id="kit_label" maxlength="8"
                                                    placeholder="KIT LABEL"  disabled>                                                                                         
                                            </div>                                      
                                        </div>
                                    </div>
                                        <div class="col-12 d-flex justify-content-end mb-2 mr-6">
                                            <button class="btn btn-info"
                                                onclick="document.getElementById('scan_label').value = ''">clear</button>
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

      });
        // START PRINT SKID
        function printskid(){
            let packing_no           = $('#packing_no').val();
            let skid_no              = $('#skid_no').val();
            let vandate              = $('#vandate').val();
            let dest                 = $('#dest').val();
            let type_skid                 = $('#type_skid').val();
            
            window.location.assign(       "{{ url('/finishgood/viewSkid/printSkid') }}" + "?packing_no=" + packing_no + "&skid_no=" + skid_no + "&vandate=" + vandate +"&dest=" + dest + "&type_skid=" + type_skid  )
        }
    </script>
@endsection
