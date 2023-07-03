@extends('layouts.main')
@section('section')
    <div class="page-wrapper">
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
                                    <a class="btn btn-primary   col-12" data-bs-toggle="collapse" href="#collapse2"
                                        role="button" aria-expanded="false" aria-controls="collapse2">
                                        <i class="ti ti-printer"></i>
                                        ASSY PRINT
                                    </a>
                                </div>
                                <div class="col-4  ">
                                    <a class="btn btn-primary col-12" data-bs-toggle="collapse" href="#origin-print"
                                    role="button" aria-expanded="false" aria-controls="origin-print">
                                        <i class="ti ti-printer"></i>
                                        ORIGINAL PRINT
                                    </a>
                                </div>
                                <div class="col-4  ">
                                    <a class="btn btn-success col-12 text-white">
                                        <i class="ti ti-printer"></i>COMBINE PRINT
                                    </a>
                                </div>
                            </div>
                            {{-- <div class="d-flex justify-content-center mb-2 ml-3 mr-3 shadow-lg">
                                <a class="btn btn-primary col-12 " href="{{ url('repacking/printkit') }}">
                                    <i class="ti ti-output"></i>
                                    ---PRINT KIT LABEL---
                                </a>
                            </div>
                            <div class="d-flex justify-content-center mb-2 ml-3 mr-3 shadow-lg">
                              <a class="btn btn-light col-12 " href="{{ url('repacking/scanIn') }}">
                                  <i class="ti ti-output"></i>
                                  ---SCAN IN PROCESS---
                              </a>
                          </div> --}}
                        </div>
                    </div>

                    <br>
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif

                <div class="collapsed-flex justify-content-right " id="origin-print">
                    <div class="col-12 ">
                        <div class="card rounded-1 col-12 mb-2">
                            <div class="justify-content-center mt-3 ml-3 mr-3 ">
                                <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                    <i class="ti ti-printer"></i> </a>
                                <a class="btn btn-success mb-2" href="{{ url('repacking') }}"> Refresh <i
                                        class="ti ti-refresh"></i> </a>
                                <a class="btn btn-primary mb-2" href="{{ url('repacking/scanIn') }}"> --Scan In--  </a>
                                    <h1 class="text-dark text-center"> Original Print</h1>
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
                                    <div class="col-12 d-flex justify-content-end mb-2 mr-6">
                                        <button class="btn btn-info"
                                            onclick="document.getElementById('scan_label').value = ''">clear</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>



                    {{-- <div class="col-12">
                        <div class="card  col-12 ">

                            <div class="collapsed-flex justify-content-right " id="collapseExample">
                                <div class="btn-group mb-2 mt-2 ml-3">
                                    <a class="btn btn-secondary mb-2" href="{{ url('repacking/logPrintOrg') }}"> Log Print
                                        <i class="ti ti-printer"></i> </a>
                                    <a class="btn btn-success mb-2" href="{{ url('repacking') }}"> Refresh <i
                                            class="ti ti-refresh"></i> </a>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">ORIGINAL PART</h3>
                                        </div>
                                        <div class="card-table table-responsive">
                                            <table class="table table-vcenter" id="repacking-org">
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
                                                        <th style="font-size: 10px;">Std Pack</th>
                                                        <th style="font-size: 10px;">Total Issue</th>
                                                        <th style="font-size: 10px;">Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $key => $value)
                                                        <tr>
                                                          

                                                            <td style="font-size: 12px;"> {{ $value->model }}</td>
                                                            <td style="font-size: 12px;"> {{ $value->prodno }}</td>
                                                            <td style="font-size: 12px;">
                                                                {{ $value->jkeipodate }}
                                                            </td>
                                                            <td style="font-size: 12px;"> {{ $value->vandate }}</td>

                                                            <td style="font-size: 12px;"> {{ $value->orderitem }}</td>
                                                            <td style="font-size: 12px;">{{ $value->custpo }} </td>
                                                            <td style="font-size: 12px;">{{ $value->partno }} </td>
                                                            <td style="font-size: 12px;">{{ $value->partname }} </td>
                                                            <td style="font-size: 12px;"> {{ $value->demand }}</td>
                                                            <td style="font-size: 12px;"> {{ $value->mcshelfno }}</td>
                                                            <td style="font-size: 12px;"> {{ $value->stdpack }}</td>
                                                            <td style="font-size: 12px;"> {{ $value->tot_scan }}</td>

                                                            <td style="font-size: 12px;">
                                                              <div class="btn-group">
                                                                <a class="btn btn-primary btn-sm text-white"
                                                                data-toggle="modal"
                                                                data-target="#printLblOriginal_{{ $value->id }}">Print
                                                                KIT</a>

                                                                <a class="btn btn-success btn-sm text-white"
                                                                href="{{url('repacking/scanCombine/' . $value->id)}}">Print Combine
                                                                </a>
                                                              </div>

                                                              
                                                                <div class="modal modal-blur fade"
                                                                    id="printLblOriginal_{{ $value->id }}"
                                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Print Label KIT</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ url('repacking/printOriginal/' . $value->id) }}"
                                                                                    method="POST">
                                                                                 
                                                                                    @csrf
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            class="form-label">PIC</label>
                                                                                        <input type="text"
                                                                                            name="scan_nik" id="scan_nik"
                                                                                            class="form-control"
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
                                        </div>



                                        </td>
                                        </tr>
                                        @endforeach
                                        </tbody>


                                        </table>
                                    </div>

                                   

                                </div>
                            </div>
                           
                        </div>
                    </div> --}}
                 
                </div>
            </div>
    </div>
    </div>

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>

    <script type="text/javascript">
    
        $(document).ready(function() {

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
                            console.log(response)
                       
                        }
                    });
                }
            });


        });
    </script>
@endsection
