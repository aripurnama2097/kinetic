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
                            Partlist
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
                        <div class="card rounded-1 col-12 ">

                            <br>
                            <br>

                            <div class="btn-group" role="group">
                                <a class="btn btn-primary  "data-bs-toggle="collapse" href="#collapse2" role="button"
                                    aria-expanded="false" aria-controls="collapse2">
                                    <i class="ti ti-printer"></i>
                                    PARTLIST SCHEDULE
                                </a>
                                <div class="col-6  ">
                                    <a class="btn btn-light col-12" data-bs-toggle="collapse" href="#collapseExample"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        ---SCAN IN---
                                    </a>

                                    {{-- <a class="btn btn-light col-12" href="{{url('partlist/scanin')}}">
                                        ---SCAN IN---
                                    </a> --}}
                                </div>
                            </div>

                            <br>

                            <div class="collapse mt-4" id="collapse2">
                                <div class="card card-body col-12 mt-4">
                                    <h2>FILTER </h2>

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{-- FILTER PROD NO --}}
                                        <form class="col-12 d-flex justify-content-left" id="print-Partlist">
                                            {{-- <input type="date" class="form-control rounded-3 form-control-sm col-2" name="jkeipodate" id="release-date" value="{{date('Y-m-d')}}">	 --}}
                                            <select style="font-size:15px" class="form-control col-2 btn btn-light btn-sm"
                                                id="filtprod-no" name="prodno">
                                                <option value="-">-- PROD NO --</option>
                                                @foreach ($dataprodno as $dd)
                                                    <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-info d-none d-sm-inline-block">
                                                <i class="ti ti-filter"></i>
                                                View
                                            </button>
                                        </form>

                                    </div>

                                    <br>


                                    <div class="table-responsive  rounded-1 shadow-sm  col-12 shadow-lg  mt-5">
                                        <table style="width:100%" id="table-print"
                                            class="text-nowrap  table table-striped border border-dark shadow-sm ">
                                            <div class="row">
                                                <div class="col-12  mt-3 p-2 ">
                                                    <h2 id="judul" style="font-size:30px"class="text-dark text-center">
                                                        PART LIST MC
                                                    </h2>
                                                </div>
                                                <div class="card mt-3 p-2 col-3">
                                                    <div class="col-4" id="contentQR"></div>
                                                    <div class="col-8" id="QRText"></div>
                                                </div>
                                            </div>

                                            <br>
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th style="font-size: 10px;">No</th>
                                                    <th style="font-size: 10px;">Part list No</th>
                                                    <th style="font-size: 10px;">Cust Code</th>
                                                    <th style="font-size: 10px;">Prod No</th>
                                                    <th style="font-size: 10px;">JKEI Po date</th>
                                                    <th style="font-size: 10px;">van Date</th>
                                                    <th style="font-size: 10px;">Cust PO</th>
                                                    <th style="font-size: 10px;">Part Number</th>
                                                    <th style="font-size: 10px;">Part Name</th>
                                                    <th style="font-size: 10px;">Demand</th>
                                                    <th style="font-size: 10px;">Std Pack</th>
                                                    {{-- <th style ="font-size: 10px;">MC Shelf No</th> --}}
                                                    <th style="font-size: 10px;">Vendor</th>
                                                </tr>
                                            </thead>

                                            <tbody id="data-print">

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- </iframe> --}}
                                </div>
                                <button id="print-btn" class="print-button float-right btn btn-primary">
                                    Print
                                    <i class="ti ti-printer"></i>
                                </button>
                            </div>

                            {{-- DATA SCAN IN --}}
                            <div class="collapsed-flex justify-content-right " id="collapseExample">
                                <p class="text-dark text-center" style="font-size:20px;font-weight:bold">
                                    MC Issue Planning
                                </p>
                                <div class="card card-body col-12 border border-secondary shadow-lg">
                                    <input
                                        class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center"
                                        type="text" name="scan_nik" value="" id="scan_nik" maxlength="8"
                                        placeholder="SCAN NIK HERE" autofocus>
                                    <input
                                        class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center"
                                        type="text" name="parlist_no" value="" id="partlist_no"
                                        placeholder="INPUT PART LIST NO" disabled>
                                    <input
                                        class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center"
                                        type="text" name="scan_label" value="" id="scan_label"
                                        placeholder="SCAN LABEL MC" disabled>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button class="btn btn-info" onclick="document.getElementById('scan_label').value = ''"> Clear </button>
                                    </div>
                                </div>


                                <div class="card-body border-bottom d-flex justify-content-center ">
                                    <div class="table-responsive  rounded-1 shadow-sm  mr-5 col-12 shadow-lg ">

                                        <table style="width:100%"
                                            class="text-nowrap  table border-bordered border border-primary shadow-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th style="font-size: 10px;">No</th>
                                                    <th style="font-size: 10px;">Cust Code</th>
                                                    <th style="font-size: 10px;">Prod No</th>
                                                    <th style="font-size: 10px;">Part Number</th>
                                                    <th style="font-size: 10px;">Part Name</th>
                                                    <th style="font-size: 10px;">Demand</th>
                                                    <th style="font-size: 10px;">Total Scan</th>
                                                    <th style="font-size: 10px;">Balance Scan</th>
                                                </tr>
                                            </thead>

                                            <tbody id="data-scanin">
                                                @foreach ($data as $u)
                                                    <tr>
                                                        <?php if ($u->tot_scan == null) {
                                                            echo '<tr style="background-color: rgb(144, 144, 144);">';
                                                        } else {
                                                            echo '<tr style="background-color:#82d489;">';
                                                            // echo '<tr style="background-color:#00c292;">';
                                                        } ?>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            {{-- END SCAN IN --}}
                            <br>
                            <a href="{{ url('/partlist') }}" class="btn btn-success ">
                                <i class="ti ti-360"></i>
                                Refresh
                            </a>
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

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


            // ==============PRINT PARTLIST==========================
            $('#print-btn').click(function() {
                var iframe = document.createElement('iframe');
                iframe.style.display = 'oke';
                document.body.appendChild(iframe);

                var content = '<html><head><title>Partlist MC</title></head><body>' +
                    $('#judul').clone().wrap('<div>').parent().html() +
                    $('#table-print1').clone().wrap('<div>').parent().html() +
                    $('#table-print').clone().wrap('<div>').parent().html() +
                    '</body></html>';

                var doc = iframe.contentWindow.document;
                doc.open();
                doc.write(content);
                doc.close();

                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            });






            // ========================FIlter PRINT PARTLIST=================================
            $('#print-Partlist').submit(function(event) {

                event.preventDefault();
                var prodNo = $('#filtprod-no').val();
                // var QRcode =  new QRCode(document.getElementById("contenQR"), 'a');

                $.ajax({
                    url: "{{ url('/partlist/filterProdno/') }}",
                    method: 'POST',
                    data: {
                        prodno: prodNo,
                        // jkeipodate:releaseDate,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        var data = ""
                        var text = $("#QRText").val(response.qr);
                        var canvas = document.getElementById('QRtext');
                        var canvas = document.getElementById('contentQR');

                        // // Create a QRCode object
                        var qr = new QRCode(canvas, {
                            text: response
                            .qr, // The data you want to encode as a QR code
                            width: 65, // The width of the QR code
                            height: 65, // The height of the QR code
                        });

                        $.each(response.data, function(key, value) {

                       

                            data = data + "<tr>"
                            data = data + "<td>" + value.id + "</td>"
                            data = data + "<td>" + value.partlist_no + "</td>"
                            data = data + "<td>" + value.custcode + "</td>"
                            data = data + "<td>" + value.prodno + "</td>"
                            data = data + "<td>" + value.jkeipodate + "</td>"
                            data = data + "<td>" + value.vandate + "</td>"
                            data = data + "<td>" + value.custpo + "</td>"
                            data = data + "<td>" + value.partno + "</td>"
                            data = data + "<td>" + value.partname + "</td>"
                            data = data + "<td>" + value.demand + "</td>"
                            data = data + "<td>" + value.stdpack + "</td>"
                            data = data + "<td>" + value.vendor + "</td>"
                            data = data + "</tr>"
                        })
                        $('#data-print').html(data);
                    }
                });
            });



            //  ===============SCAN  IN PROCESSS=================================
            $("#scan_nik").focusin(function() {
                $(this).css("background-color", "lightgreen");
            });
            $("#partlist_no").focusin(function() {
                $(this).css("background-color", "lightgreen");
            });
            $("#scan_label").focusin(function() {
                $(this).css("background-color", "lightgreen");
            });
            // =========

            $('#scan_nik').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_nik = $('#scan_nik').val();
                    if (val_nik != '') {
                        $('#partlist_no').attr('disabled', false);
                        $('#scan_label').attr('disabled', false);
                        $('#partlist_no').focus();
                    }
                }
            })


            //STEP 1.  DAPATKAN DATA PARTLIST NUMBER
            $('#partlist_no').on('keypress', function(e) {
                event.preventDefault();
                var counter = 0;

                //menambahkan nomor urut pada tabel
                $("#tabel_data tr:has(td)").each(function() {
                    $(this).prepend("<td>" + (++counter) + "</td>");
                });


                $('.color-cell').each(function() {
                    var cellValue = parseInt($(this).text());
                    if (cellValue > 20) {
                        $(this).css('background-color', 'red');
                    }
                });

                if (e.which == 13) {
                    let val_partlistNo = $('#partlist_no').val();
                    if (val_partlistNo != '') {
                        $('#scan_label').attr('disabled', false);

                        var partlistNo = $('#partlist_no').val();

                        // SEND AJAX REQUEST DATA
                        $.ajax({
                            url: "{{ url('/partlist/filter_scan/') }}",
                            method: 'POST',
                            data: {
                                partlist_no: partlistNo,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                var dataScan = ""
                                // if (response.success) {
                                //     swal.fire({
                                //         icon: 'success',
                                //         title: response.message,
                                //         // timer: 5000,
                                //         showConfirmButton: true,

                                //     })
                                // } else {
                                //     swal.fire({
                                //         icon: 'error',
                                //         title: response.message,
                                //         // timer: 5000,
                                //         showConfirmButton: true,


                                //     })
                                // }
                                // console.log("dataScan partlist",dataScan);
                                $.each(response, function(key, value) {

                                    dataScan = dataScan + "<tr>"
                                        if (value.tot_scan == 0 && value.balance_issue == 0) {
                                            dataScan = dataScan + "<tr class=table-light>";
                                        }
                                        if (value.tot_scan != 0 && value.balance_issue != 0) {
                                            dataScan = dataScan + "<tr class=table-warning>";
                                        }
                                        if (value.tot_scan == value.demand && value.balance_issue == 0) {
                                            dataScan = dataScan + "<tr class=table-success>";
                                        }

                                        dataScan = dataScan + "<td>" + value.id + "</td>"
                                        dataScan = dataScan + "<td>" + value.custcode + "</td>"
                                        dataScan = dataScan + "<td>" + value.prodno + "</td>"
                                        dataScan = dataScan + "<td>" + value.partno + "</td>"
                                        dataScan = dataScan + "<td>" + value.partname + "</td>"
                                        dataScan = dataScan + "<td>" + value.demand + "</td>"
                                        dataScan = dataScan + "<td>" + value.tot_scan + "</td>"
                                        dataScan = dataScan + "<td>" + value.balance_issue + "</td>"
                                    dataScan = dataScan + "</tr>"
                                })
                                $('#data-scanin').html(dataScan);
                                $('#scan_label').focus();
                            }



                        });
                    }
                }
            });


            //STEP 2. SCAN LABEL MC
            $('#scan_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {

                    // var parlistno = $('#partlist_no').val();
                    var scan_label = $('#scan_label').val();

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/partlist/scan_issue/') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            scan_label: scan_label
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.success) {
                                swal.fire({
                                    icon: 'success',
                                    title: response.message,

                                    timer: 5000,
                                    showConfirmButton: true,

                                })
                            } else {
                                console.log("warning",response.message);
                                let warningMessage = response.message;
                                console.log("message",warningMessage.indexOf('Loose'))
                                if(warningMessage.indexOf('Loose') == -1){
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response.message
                                    })
                                    return;
                                }

                                Swal.fire({
                                    icon: 'warning',
                                    title: response.message,
                                    showDenyButton: true,
                                    confirmButtonText: 'Loose Control',
                                    denyButtonText: `Continue`,
                                }).then((result) => {
                                 
                                    if (result.isConfirmed) {
                                        // Swal.fire('Oke Loose Carton')
                                        $.ajax({
                                            type: "POST",
                                            dataType: "json",
                                            url: "{{ url('/partlist/looseCarton/') }}",
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                    ).attr('content')
                                            },
                                            data: {
                                                scan_label: scan_label
                                            },
                                            success: function(response) {
                                                console.log(response)
                                            }
                                        })
                                    } else if (result.isDenied) {
                                        Swal.fire('Continue scan')
                                        $.ajax({
                                            type: "POST",
                                            dataType: "json",
                                            url: "{{ url('/partlist/scan_continue/') }}",
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                    ).attr('content')
                                            },
                                            data: {
                                                scan_label: scan_label
                                            },
                                            success: function(response) {
                                                console.log(response)
                                            }
                                        })
                                    }
                                })
                                return;

                            }

                            var data = ""
                            console.log(response.data);
                            $.each(response.data, function(key, value) {
                                // console.log('key=>'+key+'|value=>'+value)

                                data = data + "<tr>"
                                if (value.tot_scan == 0 && value.balance_issue == 0) {
                                    data = data + "<tr class=table-light>";
                                }
                                if (value.tot_scan != 0 && value.balance_issue != 0) {
                                    data = data + "<tr class=table-warning>";
                                }
                                if (value.tot_scan == value.demand && value
                                    .balance_issue == 0) {
                                    data = data + "<tr class=table-success>";
                                }

                                data = data + "<td>" + value.id + "</td>"
                                data = data + "<td>" + value.custcode + "</td>"
                                data = data + "<td>" + value.prodno + "</td>"
                                data = data + "<td>" + value.partno + "</td>"
                                data = data + "<td>" + value.partname + "</td>"
                                data = data + "<td>" + value.demand + "</td>"
                                data = data + "<td>" + value.tot_scan + "</td>"
                                data = data + "<td>" + value.balance_issue +
                                    "</td>"

                                data = data + "</tr>"
                            })
                            $('#data-scanin').html(data);
                            $('#scan_label').focus();
                        }
                    });
                }
            });
            // ========================END SCAN  IN PROCESSS================================


        });

       
    </script>
@endsection
