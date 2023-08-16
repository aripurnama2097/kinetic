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
                                <a class="btn btn-primary text-white" data-bs-toggle="collapse" id="btn-print"  role="button"
                                    aria-expanded="false" aria-controls="partlist">
                                    <i class="ti ti-printer"></i>
                                    PARTLIST SCHEDULE
                                </a>
                                <div class="col-6  ">
                                    <a class="btn btn-light col-12" data-bs-toggle="collapse"  id="btn-scanin"
                                        role="button" aria-expanded="false" aria-controls="scanin">
                                        ---SCAN IN---
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="collapse mt-4" id="partlist" hide>
                                <div class="div ml-3">

                                    <h2 class="text-dark">SCHEDULE PARTLIST</h2>
                                </div>
                             <div class="card card-body col-12 mt-4">
                                <div class="table-responsive  rounded-1  col-12">
                                    <table style="width:100%" id="sch-mc"
                                    class="table table-striped shadow" >
                                            <thead class="thead-primary" >
                                                <tr>
                                                    <th class="text-center"style="font-size:14px;text-center;border-color:black">Partlist No</th>
                                                    <th class="text-center"style="font-size:14px;text-center;border-color:black">Cust Code</th>
                                                    <th class="text-center"style="font-size:14px;text-center;border-color:black">Prod No</th>
                                                    <th class="text-center"style="font-size:14px;text-center;border-color:black">Order Item</th>
                                                    <th class="text-center"style="font-size:14px;text-center;border-color:black">Vandate</th>
                                                    <th class="text-center"style="font-size:14px;text-center;border-color:black">Release Date</th>
                                                    {{-- <th class="text-center"style="font-size:14px;text-center;border-color:black">Status</th> --}}

                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($sch_mc as $key => $value)
                                                <tr>
                                                <td class="text-center">{{$value->partlist_no}} </td>
                                                <td class="text-center">{{$value->custcode}} </td>
                                                <td class="text-center">{{$value->prodno}} </td>
                                                <td class="text-center">{{$value->orderitem}} </td>
                                                <td class="text-center">{{$value->vandate}} </td>
                                                <td class="text-center">{{$value->release_date}} </td>
                                                </tr>


                                                @endforeach

                                            </tbody>
                                        </table>
                                    {{-- </iframe> --}}
                                </div>
                            </div>
                                <div class="card card-body col-12 mt-4">
                                    <h2>FILTER PRINT</h2>

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{-- FILTER PROD NO --}}
                                        <form class="col-12 d-flex justify-content-left" id="print-Partlist">
                                            {{-- <input type="date" class="form-control rounded-3 form-control-sm col-2" name="jkeipodate" id="release-date" value="{{date('Y-m-d')}}">	 --}}
                                            <select style="font-size:15px" class="form-control col-2 btn btn-light btn-sm"
                                                id="filtprod-no" name="prodno">
                                                <option value="-">-- PROD NO --</option>
                                                @foreach ($dataprodno as $dd)
                                                    <option value="{{ $dd->prodno }}">{{ $dd->prodno }} / {{ $dd->created_at }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-info d-none d-sm-inline-block">
                                                <i class="ti ti-filter"></i>
                                                View
                                            </button>
                                        </form>

                                    </div>

                                    <br>

                                    <div class="table-responsive  rounded-1 shadow-sm  col-12 shadow-lg  mt-5 col-12">
                                        {{-- <iframe id='print-iframe' name='print-frame-name'> --}}
                                        <table style="width:100%" id="table-print"
                                        class="table table-bordered print">
                                                {{-- <div class="row"> --}}
                                                    <div class="col-12  mt-3 p-2 ">
                                                        <h2 id="judul" style="font-size:30px;text-align:center">
                                                            PART LIST MC
                                                        </h2>
                                                    </div>
                                                    <div class="row">
                                                        {{-- <div class="card mt-3 p-2 col-12 row"> --}}
                                                            <div class="col-1 ml-4" id="contentQR"></div>
                                                            <div class="col-4 text-dark" style="position:right;font-color:black;font-size:16px" id="QRText"></div>
                                                        {{-- </div> --}}
                                                    </div>
                                                {{-- </div> --}}
                                                <br>
                                                <thead class="thead-dark">
                                                    <tr id="tr-id">
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Cust PO</th>
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Vandate</th>
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Part Number</th>
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Part Name</th>
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Demand</th>
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Std Pack</th>
                                                        <th  class="text-center"style="font-size: 17px;text-center;border-color:black">Lokasi</th>
                                                        <th class="text-center"style="font-size: 17px;text-center;border-color:black">Vendor</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="data-print">

                                                </tbody>
                                            </table>
                                        {{-- </iframe> --}}
                                    </div>

                                    {{-- </iframe> --}}
                                   </div>
                                <button id="print-btn" class="print-button float-right btn btn-primary">
                                    Print
                                    <i class="ti ti-printer"></i>
                                </button>
                            </div>

                            {{-- DATA SCAN IN --}}
                            <div class="collapse mt-4" id="scanin" hide>
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
                                        type="text" name="partlist_no" value="" id="partlist_no"
                                        placeholder="SCAN QR PARTLIST" disabled>
                                    <input
                                        class="form-control form-control-lg mb-3 text-center border border-secondary  d-flex justify-content-center"
                                        type="text" name="scan_label" value="" id="scan_label"
                                        placeholder="SCAN LABEL MC" disabled>
                                    <div class="col-12 d-flex justify-content-end">
                                        {{-- <button class="btn btn-primary text-white" data-bs-toggle="collapse" id="btn-show"  role="button"
                                        aria-expanded="false" aria-controls="partlist"></i> Show Data Collapse</button> --}}
                                        <button class="btn btn-warning mr-2" onclick ="showData()" ><i class="ti ti-theater"></i> Show Data</button>

                                    </div>
                                    <audio id="audio">
                                        <source id="audioSource" src="{{asset('')}}storage/sound/OK.mp3" type="audio">
                                    </audio>
                                </div>

                                {{-- SHOW SCAN --}}
                                <div class="collapse mt-4" id="show-scan" hide>
                                    <div class="col-12 ">
                                        <div class="table-responsive  rounded-1 shadow-sm">
                                            <table style="width:100%" id="show-scan" class="table  table-bordered">
                                                <thead class="thead-dark">
                                                    <tr class="headings">
                                                        <th style="font-size: 10px;">No</th>
                                                        <th style="font-size: 10px;">Custcode</th>

                                                        <th style="font-size: 10px;">Prod No</th>

                                                        <th style="font-size: 10px;">Cust PO</th>
                                                        <th style="font-size: 10px;">Part Number</th>
                                                        <th style="font-size: 10px;">Part Name</th>
                                                        <th style="font-size: 10px;">Demand</th>
                                                        <th style="font-size: 10px;">Total Scan</th>
                                                        <th style="font-size: 10px;">Balance Scan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>



                                                    <?php
                                                    $no = 1
                                                    ?>
                                                    @foreach ($data as $key => $value)
                                                    <tr>

                                                    <td style="font-size: 12px;">{{ $no}}</td>
                                                    <td style="font-size: 12px;">{{ $value->custcode }}</td>
                                                    <td style="font-size: 12px;"> {{ $value->prodno }}</td>
                                                    <td style="font-size: 12px;">{{ $value->custpo }} </td>
                                                    <td style="font-size: 12px;">{{ $value->partno }} </td>
                                                    <td style="font-size: 12px;">{{ $value->partname }} </td>
                                                    <td  style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td>
                                                    <td  style="font-size: 14px; font-weight:bold"> {{ $value->tot_scan }}</td>
                                                    <td  class="text-danger"style="font-size: 14px;"> {{ $value->balance_issue }}</td>
                                                    </tr>
                                                    <?php $no++ ;?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <a  class="btn btn-info  btn-sm text-light mt-2" href="{{url('/partlist')}}" ><i class="ti ti-arrow-narrow-left"></i>BACK</a>
                           </div>
                                </div>

                                <div class="card-body border-bottom d-flex justify-content-center">
                                    <div class="table-responsive  rounded-1 shadow-sm  mr-5 col-12 shadow-lg ">

                                        <table style="width:100%"
                                            class="text-nowrap  table border-bordered border border-primary shadow-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    {{-- <th style="font-size: 10px;">No</th> --}}
                                                    <th style="font-size: 10px;">Cust Code</th>
                                                    <th style="font-size: 10px;">Cust PO</th>
                                                    <th style="font-size: 10px;">Prod No</th>
                                                    <th style="font-size: 10px;">Part Number</th>
                                                    <th style="font-size: 10px;">Part Name</th>
                                                    <th style="font-size: 10px;">Demand</th>
                                                    <th style="font-size: 10px;">Std Pack</th>
                                                    <th style="font-size: 10px;">Total Scan</th>
                                                    <th style="font-size: 10px;">Balance Scan</th>
                                                </tr>
                                            </thead>

                                            <tbody id="data-scanin">
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).ready(function() {

            $('#sch-mc').DataTable( {
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                    'csvHtml5'
                ]
            } );

            $('#btn-print').on('click', function(){
                $('#scanin').hide();
                $('#partlist').show();
            })

            $('#btn-scanin').on('click', function(){
                $('#partlist').hide();
                $('#scanin').show();
            })

            $('#btn-show').on('click', function(){
                $('#partlist').hide();
                $('#scanin').show();
                $('#show-scan').show();
            })

            // ==============PRINT PARTLIST==========================
            $('#print-btn').click(function() {
                var iframe = document.createElement('iframe');
                iframe.style.display = 'oke';
                document.body.appendChild(iframe);

                var content = '<html><body>' +
                                    //  $('#judul').clone().wrap('<div>').parent().html() +
                                     $('#contentQR').clone().wrap('<div>').parent().html()  +
                                     $('#QRText').clone().wrap('<div>').parent().html() + '<br>'+
                                    //  '<table id="table-print style="border:1px solid black"> <thead style="text-center"> <th>' +
                                     $('#table-print').clone().wrap('<div>').parent().html() +
                                    //     +
                                    //  '<tbody id="data-print" style="border:1px solid black"> </tbody> </table>'
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

                        console.log(response.qr, "QR Text")
                        $('#QRText').html(response.qr);
                        $.each(response.data, function(key, value) {



                            data = data + "<tr>"
                            // data = data + "<td>" + value.id + "</td>"
                            // data = data + "<td>" + value.partlist_no + "</td>"
                            // data = data + "<td>" + value.custcode + "</td>"
                            // data = data + "<td>" + value.prodno + "</td>"
                            // data = data + "<td>" + value.jkeipodate + "</td>"
                            data = data + "<td style=font-size:13px;text-align:center;border-color:black>" + value.custpo + "</td>"
                            data = data + "<td style=font-size:13px;text-align:center;border-color:black>" + value.vandate + "</td>"
                            data = data + "<td style=font-size:13px;text-align:center;border-color:black>" + value.partno + "</td>"
                            data = data + "<td style=font-size:12px;text-align:center;border-color:black>" + value.partname + "</td>"
                            data = data + "<td style=font-size:13px;text-align:center;border-color:black>" + value.demand + "</td>"
                            data = data + "<td style=font-size:13px;text-align:center;border-color:black>" + value.stdpack + "</td>"
                            data = data + "<td style=font-size:13px;text-align:center;border-color:black>" + value.mcshelfno + "</td>"
                            data = data + "<td style=font-size:12px;text-align:center;border-color:black>" + value.vendor + "</td>"
                            data = data + "</tr>"
                        })
                        $('#data-print').html(data);
                    }
                });
            });


            //  ===============SCAN  IN PROCESSS=================================
            $("#scan_nik").focusin(function() {
                $(this).css("background-color", "lightblue");
            });
            $("#partlist_no").focusin(function() {
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
                        $('#partlist_no').attr('disabled', false);
                        $('#scan_label').attr('disabled', false);
                        $('#partlist_no').focus();
                    }
                }
            })


            //STEP 1.  DAPATKAN DATA PARTLIST NUMBER
            $('#partlist_no').on('keypress', function(e) {

                // var counter = 0;

                // //menambahkan nomor urut pada tabel
                // $("#tabel_data tr:has(td)").each(function() {
                //     $(this).prepend("<td>" + (++counter) + "</td>");
                // });


                // $('.color-cell').each(function() {
                //     var cellValue = parseInt($(this).text());
                //     if (cellValue > 20) {
                //         $(this).css('background-color', 'red');
                //     }
                // });

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

                              $.each(response.data, function(key, value) {

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

                                    //   dataScan = dataScan + "<td>" + value.id + "</td>"
                                      dataScan = dataScan + "<td>" + value.custcode + "</td>"
                                      dataScan = dataScan + "<td>" + value.custpo + "</td>"
                                      dataScan = dataScan + "<td>" + value.prodno + "</td>"
                                      dataScan = dataScan + "<td>" + value.partno + "</td>"
                                      dataScan = dataScan + "<td>" + value.partname + "</td>"
                                      dataScan = dataScan + "<td>" + value.demand + "</td>"
                                      dataScan = dataScan + "<td>" + value.stdpack+ "</td>"
                                      dataScan = dataScan + "<td>" + value.tot_scan + "</td>"
                                      dataScan = dataScan + "<td>" + value.balance_issue + "</td>"
                                  dataScan = dataScan + "</tr>"
                              })
                              $('#data-scanin').html(dataScan);
                              $('#scan_label').focus();


                                if (response.success) {
                                swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton :false,
                                    timer:100



                                })
                                    var audio = document.getElementById('audio');
                                    var source = document.getElementById('audioSource');
                                    var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                    audio.load()
                                    audio.play();
                            }

                            else{
                                swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    showConfirmButton :false,
                                    timer:2000


                                })
                                let warningMessage = response.message;

                                console.log("message",warningMessage.indexOf('Part'))
                                if(warningMessage.indexOf('Part') == 0){
                                    Swal.fire({

                                        icon: 'warning',
                                        title: response.message,
                                        showConfirmButton :false,
                                        timer:1000


                                    })


                                    var audio = document.getElementById('audio');
                                                var source = document.getElementById('audioSource');
                                                var audio = new Audio("{{asset('')}}storage/sound/partlist_not.mp3");
                                                audio.load()
                                                audio.play();


                                    return;
                                }

                            }


                            }



                        });
                    }
                }
            });


            //STEP 2. SCAN IN MC PROCESS
            $('#scan_label').on('keypress', function(e) {
                // e.preventDefault();
                if (e.which == 13) {

                    var partlist_no = $('#partlist_no').val();
                    var scan_label = $('#scan_label').val();
                    console.log("1. Label Scan: ",scan_label);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/partlist/scan_issue/') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            partlist_no: partlist_no,
                            scan_label: scan_label
                        },
                        success: function(response) {
                            console.log("2.scan Issue: ",response)
                            var data = ""
                            $.each(response.data, function(key, value) {

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

                                // data = data + "<td>" + value.id + "</td>"
                                data = data + "<td>" + value.custcode + "</td>"
                                data = data + "<td>" + value.custpo + "</td>"
                                data = data + "<td>" + value.prodno + "</td>"
                                data = data + "<td>" + value.partno + "</td>"
                                data = data + "<td>" + value.partname + "</td>"
                                data = data + "<td>" + value.demand + "</td>"
                                data = data + "<td>" + value.stdpack+ "</td>"
                                data = data + "<td>" + value.tot_scan + "</td>"
                                data = data + "<td>" + value.balance_issue +
                                    "</td>"

                                data = data + "</tr>"
                            })
                            $('#data-scanin').html(data);
                            $('#scan_label').focus();
                            $('#scan_label').val("");

                            //ALERT SUCCESS/LOOSE CARTON
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
                                    timer:100

                                    // timer: 5000

                                })
                            }

                            else {
                                let warningMessage = response.message;

                                console.log("message",warningMessage.indexOf('Loose'))
                                console.log("message",warningMessage.indexOf('WRONG'))
                                console.log("message",warningMessage.indexOf('DOUBLE'))
                                console.log("message",warningMessage.indexOf('OVER'))
                                console.log("message",warningMessage.indexOf('PART'))
                                console.log("message",warningMessage.indexOf('DEMAND'))
                                console.log("message",warningMessage.indexOf('QTY'))
                                    if(warningMessage.indexOf('WRONG') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:1000


                                        })


                                        var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/wrong_part.mp3");
                                                    audio.load()
                                                    audio.play();
                                                    return;

                                        return;
                                    }

                                    if(warningMessage.indexOf('DOUBLE') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:1000


                                        })


                                        var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/double_scan.mp3");
                                                    audio.load()
                                                    audio.play();
                                                    return;

                                        return;
                                    }

                                    if(warningMessage.indexOf('OVER') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:1000


                                        })


                                        var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/over_demand.mp3");
                                                    audio.load()
                                                    audio.play();


                                        return;
                                    }

                                    if(warningMessage.indexOf('PART') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:1000


                                        })


                                                    var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/part_notstdpack.mp3");
                                                    audio.load()
                                                    audio.play();


                                        return;
                                    }

                                    if(warningMessage.indexOf('DEMAND') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:1000


                                        })


                                                    var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/scan_complete.mp3");
                                                    audio.load()
                                                    audio.play();


                                        return;
                                    }

                                      if(warningMessage.indexOf('QTY') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:1000


                                        })


                                                    var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/Over_Qty.mp3");
                                                    audio.load()
                                                    audio.play();


                                        return;
                                    }


                                Swal.fire({

                                    icon: 'warning',
                                    title: response.message,
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: 'Loose Control',
                                    denyButtonText: `Start Combine`,
                                    cancelButtonText: 'Continue Combine'
                                }).then((result) => {
                                    console.log("3. Loose Carton Swal: ", result)

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
                                                partlist_no: partlist_no,
                                                scan_label: scan_label
                                            },
                                            success: function(response) {
                                                console.log("4. looseCarton Check: ", response);

                                                var audio = document.getElementById('audio');
                                                var source = document.getElementById('audioSource');
                                                var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                                audio.load()
                                                audio.play();

                                                // console.log(response.data);
                                                var data = ""
                                                $.each(response.data, function(key, value) {
                                                    // console.log('key=>'+key+'|value=>'+value)

                                               data =data + "<tr>"
                                                if (value.tot_scan == 0 && value.balance_issue == 0) {
                                                   data =data + "<tr class=table-light>";
                                                }
                                                if (value.tot_scan != 0 && value.balance_issue != 0) {
                                                   data =data + "<tr class=table-warning>";
                                                }
                                                if (value.tot_scan == value.demand && value
                                                    .balance_issue == 0) {
                                                   data =data + "<tr class=table-success>";
                                                }

                                            //    data =data + "<td>" + value.id + "</td>"
                                               data =data + "<td>" + value.custcode + "</td>"
                                               data = data + "<td>" + value.custpo + "</td>"
                                               data =data + "<td>" + value.prodno + "</td>"
                                               data =data + "<td>" + value.partno + "</td>"
                                               data =data + "<td>" + value.partname + "</td>"
                                               data =data + "<td>" + value.demand + "</td>"
                                               data = data + "<td>" + value.stdpack + "</td>"
                                               data =data + "<td>" + value.tot_scan + "</td>"
                                               data =data + "<td>" + value.balance_issue +
                                                    "</td>"

                                               data = data + "</tr>"
                                            })
                                            $('#data-scanin').html(data);
                                            $('#scan_label').focus();
                                            $('#scan_label').val("");

                                            }
                                        })
                                    } else if (result.isDenied) {
                                        // Swal.fire('Continue scan')

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
                                                partlist_no: partlist_no,
                                                scan_label: scan_label
                                            },
                                            success: function(response) {
                                                let warningMessage = response.message;
                                                // console.log("message",warningMessage.indexOf('OVER'));
                                                console.log("5. Continue Check: ", response);

                                                var audio = document.getElementById('audio');
                                                var source = document.getElementById('audioSource');
                                                var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                                audio.load()
                                                audio.play();

                                                console.log(response)

                                                var data = ""
                                                $.each(response.data, function(key, value) {
                                                    // console.log('key=>'+key+'|value=>'+value)

                                               data =data + "<tr>"
                                                if (value.tot_scan == 0 && value.balance_issue == 0) {
                                                   data =data + "<tr class=table-light>";
                                                }
                                                if (value.tot_scan != 0 && value.balance_issue != 0) {
                                                   data =data + "<tr class=table-warning>";
                                                }
                                                if (value.tot_scan == value.demand && value
                                                    .balance_issue == 0) {
                                                   data =data + "<tr class=table-success>";
                                                }

                                            //    data =data + "<td>" + value.id + "</td>"
                                               data =data + "<td>" + value.custcode + "</td>"
                                               data = data + "<td>" + value.custpo + "</td>"
                                               data =data + "<td>" + value.prodno + "</td>"
                                               data =data + "<td>" + value.partno + "</td>"
                                               data =data + "<td>" + value.partname + "</td>"
                                               data =data + "<td>" + value.demand + "</td>"
                                               data = data + "<td>" + value.stdpack + "</td>"
                                               data =data + "<td>" + value.tot_scan + "</td>"
                                               data =data + "<td>" + value.balance_issue +
                                                    "</td>"

                                               data = data + "</tr>"
                                            })
                                            $('#data-scanin').html(data);
                                            $('#scan_label').focus();
                                            $('#scan_label').val("");
                                            }
                                        })
                                    } else if(result.isDismissed){
                                        // Swal.fire('Oke Continue END !')
                                        $.ajax({
                                            type: "POST",
                                           dataType: "json",
                                            url: "{{ url('/partlist/scan_end_continue/') }}",
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]'
                                                    ).attr('content')
                                            },
                                            data: {
                                                partlist_no: partlist_no,
                                                scan_label: scan_label
                                            },
                                            success: function(response) {
                                                console.log("6. End Continue Check: ", response);
                                                if(response.success == false){
                                                    Swal.fire({

                                                        icon: 'warning',
                                                        title: response.message,
                                                        showConfirmButton :false,
                                                        timer:200


                                                    })


                                                    var audio = document.getElementById('audio');
                                                                var source = document.getElementById('audioSource');
                                                                var audio = new Audio("{{asset('')}}storage/sound/over_demand.mp3");
                                                                audio.load()
                                                                audio.play();


                                                    return;
                                                }
                                                var audio = document.getElementById('audio');
                                                var source = document.getElementById('audioSource');
                                                var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                                audio.load()
                                                audio.play();

                                                console.log(response)

                                                var data = ""
                                                $.each(response.data, function(key, value) {
                                                    // console.log('key=>'+key+'|value=>'+value)

                                               data =data + "<tr>"
                                                if (value.tot_scan == 0 && value.balance_issue == 0) {
                                                   data =data + "<tr class=table-light>";
                                                }
                                                if (value.tot_scan != 0 && value.balance_issue != 0) {
                                                   data =data + "<tr class=table-warning>";
                                                }
                                                if (value.tot_scan == value.demand && value
                                                    .balance_issue == 0) {
                                                   data =data + "<tr class=table-success>";
                                                }

                                            //    data =data + "<td>" + value.id + "</td>"
                                               data =data + "<td>" + value.custcode + "</td>"
                                               data = data + "<td>" + value.custpo + "</td>"
                                               data =data + "<td>" + value.prodno + "</td>"
                                               data =data + "<td>" + value.partno + "</td>"
                                               data =data + "<td>" + value.partname + "</td>"
                                               data =data + "<td>" + value.demand + "</td>"
                                               data = data + "<td>" + value.stdpack + "</td>"
                                               data =data + "<td>" + value.tot_scan + "</td>"
                                               data =data + "<td>" + value.balance_issue +
                                                    "</td>"

                                               data = data + "</tr>"
                                            })
                                            $('#data-scanin').html(data);
                                            $('#scan_label').focus();
                                            $('#scan_label').val("");
                                            }
                                        })
                                    }
                                })
                                var audio = document.getElementById('audio');
                                                var source = document.getElementById('audioSource');
                                                var audio = new Audio("{{asset('')}}storage/sound/loose_carton.mp3");
                                                audio.load()
                                                audio.play();
                                return;

                            }


                        }
                    });
                }
            });
            // ========================END SCAN  IN PROCESSS================================


        });

       function showData(){
        // let scan_label = $('#scan_label').val();
        let partlist_no = $('#partlist_no').val();

        window.location.assign("{{ url('/partlist/showscan') }}" + "?partlist_no=" + partlist_no  )

       }
    </script>
@endsection
