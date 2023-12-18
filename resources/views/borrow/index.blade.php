@extends('layouts.main')


@section('section')
    <div class="container">
        @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif

        <div class="col-md-12 ">
            <div class="col-md-12 mt-3 ml-0">
                <div class="btn-group col-12 mt-5 mb-5" role="group">
                    <a class="btn btn-primary col-4 text-white" data-bs-toggle="collapse" id="btn-takeout" role="button"
                        aria-expanded="false" aria-controls="take_out">
                        Borrow Takeout <i class="ti ti-arrow-big-right-lines-filled"></i>
                    </a>

                    <a class="btn btn-success col-4 text-white" data-bs-toggle="collapse" id="btn-return" role="button"
                        aria-expanded="false" aria-controls="return"><i class="ti ti-arrow-big-left-lines-filled"></i>
                        Borrow Return
                    </a>
                    {{-- <div class="d-flex justify-content-center"> --}}
                        <a class="btn btn-dark col-4 text-white text-center" data-bs-toggle="collapse" id="btn-show"
                            role="button" aria-expanded="false" aria-controls="return"><i class="ti ti-table-down"></i>
                            Data Borrow
                        </a>
                    {{-- </div> --}}
                </div>
            </div>

            <div class="collapse mt-4" id="take_out" hide>
                <form action="{{ url('problem/create') }}" method="post" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 style="font-size:25px"class="card-title text-primary">Borrow Take Out</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label required">SCAN PIC(Borrower)</label>
                                <div>
                                    <input type="text" class="form-control" name="borrower" id="borrower"
                                        placeholder="SCAN NIK" required autofocus minlength="5">
                                    <small class="form-hint">
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label required">Reason</label>
                                <select class="form-control" name="reason" id="reason" required disabled>
                                    <option>--Select Reason--</option>
                                    <option>Claim</option>
                                    <option>Feedback</option>
                                    <option>Rework</option>
                                    <option>Sampling</option>
                                </select>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label required">SCAN PIC (Lender)</label>
                                <div>
                                    <input type="text" class="form-control" name="lender" id="lender"
                                        placeholder="SCAN NIK" required disabled>
                                    <small class="form-hint">
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label required">Symptom</label>
                                <div>
                                    <select class="form-control" name="symptom" id="symptom" required >
                                        <option>--Select Symptom--</option>
                                        <option>Bending</option>
                                        <option>Broken</option>
                                        <option>Crack</option>
                                        <option>Dented</option>
                                        <option>Different Color</option>
                                        <option>Dimension NG</option>
                                        <option>Dirty</option>
                                        <option>Flashes</option>
                                        <option>Mixing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label required">Status</label>
                                <select class="form-control" name="status" id="status" required disabled>
                                    <option>--Select Status--</option>
                                    <option>Shipment Hold</option>
                                    <option>WIP</option>
                                    <option>Conditional Acceptance</option>
                                    <option>Lot Out</option>
                                </select>
                            </div>


                            <div class="mb-3 col-6">
                                <label class="form-label required">Est Return</label>
                                <div>
                                    <input type="date" class="form-control" name="est_return" id="est_return"
                                        placeholder="EST RETURN" required disabled>
                                    <small class="form-hint">
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label required">Dept</label>
                                <select class="form-control" name="dept" id="dept" required disabled>
                                    <option>--Select Dept--</option>
                                    <option>QA</option>
                                    <option>IQC</option>
                                    <option>Planning</option>

                                </select>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label required">SCAN LABEL</label>
                                <input type="text" class="form-control" name="scan_label" id="scan_label"
                                    placeholder="SCAN LABEL KIT" required disabled>
                                <small class="form-hint">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body border-bottom d-flex justify-content-center ">
                    <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
                        <table style="width:100%" class="table table-vcenter table-striped">
                            <thead>
                                <tr>

                                    <th style="font-size: 14px;">Custpo</th>
                                    <th style="font-size: 14px;">Partno</th>
                                    <th style="font-size: 14px;">Qty</th>
                                    <th style="font-size: 14px;">Symptom</th>
                                    <th style="font-size: 14px;">Borrower</th>
                                    <th style="font-size: 14px;">Lender</th>
                                    <th style="font-size: 14px;">Dateout</th>
                                    <th style="font-size: 14px;">Status</th>
                                    <th style="font-size: 14px;">Dept</th>
                                    <th style="font-size: 14px;">Reason</th>
                                    <th style="font-size: 14px;">Est return</th>
                                </tr>
                            </thead>
                            <tbody id="borrow-takeout">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="collapse mt-4" id="return">
                <div class="btn-group mb-2">
                    {{-- <a class="btn btn-dark text-light ">
                        Show Data<i class="ti ti-caret-down"></i>
                    </a> --}}
                </div>
                <form class="card">
                    <div class="card-header">
                        <h3 style="font-size:25px"class="card-title text-primary">Borrow Return</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 col-12">
                            <label class="form-label required">SCAN DIC(Return)</label>
                            <div>
                                <input type="text" class="form-control" name="dic_return" id="dic_return"
                                    placeholder="SCAN NIK" required autofocus minlength="5">
                                <small class="form-hint">
                                </small>
                            </div>
                        </div>


                        <div class="mb-3 col-12">
                            <label class="form-label required">SCAN PIC (Receiver)</label>
                            <div>
                                <input type="text" class="form-control" name="receiver" id="receiver"
                                    placeholder="SCAN NIK" required disabled>
                                <small class="form-hint">
                                </small>
                            </div>
                        </div>


                        <div class="mb-3 col-12">
                            <label class="form-label ">REMARK</label>
                            <div>
                                <input type="text" class="form-control" name="remark" id="remark"
                                    placeholder="REMARK" disabled>
                                <small class="form-hint">
                            </div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label required">SCAN LABEL</label>
                            <div>
                                <input type="text" class="form-control" name="label_kit" id="label_kit"
                                    placeholder="SCAN LABEL KIT" required disabled>
                                <small class="form-hint">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body border-bottom d-flex justify-content-center ">
                  <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
                      <table style="width:100%" class="table table-vcenter table-striped">
                          <thead>
                              <tr>
  
                                  <th style="font-size: 14px;">Custpo</th>
                                  <th style="font-size: 14px;">Partno</th>
                                  <th style="font-size: 14px;">Qty</th>
                                  <th style="font-size: 14px;">Symptom</th>
                                  <th style="font-size: 14px;">Borrower</th>
                                  <th style="font-size: 14px;">Lender</th>
                                  <th style="font-size: 14px;">Dateout</th>
                                  <th style="font-size: 14px;">Status</th>
                                  <th style="font-size: 14px;">Dept</th>
                                  <th style="font-size: 14px;">Reason</th>
                                  <th style="font-size: 14px;">Est return</th>
                                  <th style="font-size: 14px;">Act return</th>
                                  <th style="font-size: 14px;">Dic return</th>
                                  <th style="font-size: 14px;">Receiver</th>
                                  <th style="font-size: 14px;">Total return</th>
                                  <th style="font-size: 14px;">Diff</th>
                              </tr>
                          </thead>
                          <tbody id="borrow-return">
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          

            {{-- END COLLAPSE BORROW RETURN --}}
        
        </div>
    </div>
    <div class="collapse mt-4 ml-3 mr-3" id="show">           
      <div class="card-body border-bottom d-flex justify-content-center ">
        {{-- <div class="card-header mb-2">
          <h3 style="font-size:15px"class="card-title text-primary"><i class="ti ti-table-down"></i>DATA BORROW</h3>
      </div> --}}
          <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
              <table style="width:100%" id="data-borrow" class="table table-vcenter table-striped">
                  <thead>
                      <tr>

                          <th style="font-size: 14px;">Prod No</th>
                          <th style="font-size: 14px;">Custpo</th>
                          <th style="font-size: 14px;">Partno</th>
                          <th style="font-size: 14px;">Qty</th>
                          <th style="font-size: 14px;">Symptom</th>
                          <th style="font-size: 14px;">Borrower</th>
                          <th style="font-size: 14px;">Lender</th>
                          <th style="font-size: 14px;">Dateout</th>
                          <th style="font-size: 14px;">Status</th>
                          <th style="font-size: 14px;">Dept</th>
                          <th style="font-size: 14px;">Reason</th>
                          <th style="font-size: 14px;">Est return</th>
                          <th style="font-size: 14px;">Act return</th>
                          <th style="font-size: 14px;">DIC return</th>
                          <th style="font-size: 14px;">Receiver</th>
                          <th style="font-size: 14px;">Tot Return</th>
                          <th style="font-size: 14px;">Diff</th>
                          <th style="font-size: 14px;">Remark</th>
                          <th style="font-size: 14px;">Created</th>
                      </tr>
                  </thead>
                  <tbody id="borrow-takeout">
                    @foreach ($data as $key => $value)     
                    <tr> 
                          <td style="font-size: 12px;">{{ $value->prodno}}</td>
                          <td style="font-size: 12px;">{{ $value->custpo}}</td>
                          <td style="font-size: 12px;"> {{ $value->partno }}</td>
                          <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->qty }}</td>
                          <td style="font-size: 12px;"> {{ $value->symptom }}</td>
                          <td style="font-size: 12px;"> {{ $value->borrower}}</td>                       
                          <td style="font-size: 12px;"> {{ $value->lender }}</td>
                          {{-- <td style="font-size: 12px;"> {{ $value->shipvia }}</td> --}}
                          <td style="font-size: 12px;">{{ $value->dateout }} </td>
                          <td style="font-size: 12px;">{{ $value->status }} </td>
                          <td style="font-size: 12px;">{{ $value->dept }} </td>
                          <td style="font-size: 12px;">{{ $value->reason }} </td>
                          <td style="font-size: 12px;">{{ $value->est_return }} </td>
                          <td style="font-size: 12px;">{{ $value->act_return }} </td>
                          <td style="font-size: 12px;">{{ $value->dic_return }} </td>
                          <td style="font-size: 12px;">{{ $value->receiver }} </td>
                          <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->tot_return }}</td> 
                          <td class="text-danger text-center" style="font-size: 14px; font-weight:bold"> {{ $value->diff }}</td> 
                          <td style="font-size: 12px;"> {{ $value->remark }}</td>
                          <td style="font-size: 12px;"> {{ $value->created_at }}</td>
                         
                                                      
                    </tr>
                     @endforeach
                  </tbody>
              </table>
          </div>
      </div>
   
    </div>
    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#data-borrow').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                
                    'excelHtml5',
                    'csvHtml5'
                ]
            });

            $('#btn-takeout').on('click', function() {
                $('#return').hide();
                $('#show').hide();
                $('#take_out').show();
            })

            $('#btn-return').on('click', function() {
              $('#show').hide();
                $('#take_out').hide();
                $('#return').show();
            })

            $('#btn-show').on('click', function() {
                $('#take_out').hide();
                $('#return').hide();
                $('#show').show();
            })


            // STEP 1. START BORROW TAKE OUT
            $('#borrower').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_borrower = $('#borrower').val();
                    if (val_borrower != '') {

                        $('#lender').attr('disabled', false);
                        $('#lender').focus();
                    }
                }
            })


            $('#lender').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_lender = $('#lender').val();
                    if (val_lender != '') {

                        $('#status').attr('disabled', false);
                        $('#status').focus();
                        $('#dept').attr('disabled', false);
                        $('#reason').attr('disabled', false);
                        $('#symptom').attr('disabled', false);
                        $('#est_return').attr('disabled', false);
                        $('#scan_label').attr('disabled', false);
                       
                    }
                }
            })

            // $('#status').on('keypress', function(e) {
            //     // if (e.which == 13) {
            //     var val_status = $('#status').val();
            //     if (val_status != '') {

            //         $('#dept').attr('disabled', false);
            //         $('#dept').focus();
            //     }
            //     // }
            // })


            // $('#dept').on('keypress', function(e) {
            //     var val_dept = $('#dept').val();
            //     if (val_dept != '') {
            //         $('#reason').attr('disabled', false);
            //         $('#reason').focus();
            //     }
            // })

            // $('#reason').on('keypress', function(e) {
            //     var val_reason = $('#reason').val();
            //     if (val_reason != '') {
            //         $('#symptom').attr('disabled', false);
            //         $('#symptom').focus();
            //     }
            // })

            // $('#symptom').on('keypress', function(e) {
            //     var val_symptom = $('#symptom').val();
            //     if (val_symptom != '') {
            //         $('#est_return').attr('disabled', false);
            //         $('#est_return').focus();
            //     }
            // })


            // $('#est_return').on('keypress', function(e) {
            //     var val_est_return = $('#est_return').val();
            //     if (val_est_return != '') {
            //         $('#scan_label').attr('disabled', false);
            //         $('#scan_label').focus();

            //     }

            // });



            $('#scan_label').on('keypress', function(e) {
                // event.preventDefault();
                if (e.which == 13) {

                    // var parlistno = $('#partlist_no').val();
                    var borrower = $('#borrower').val();
                    var lender = $('#lender').val();
                    var status = $('#status').val();
                    var dept = $('#dept').val();
                    var reason = $('#reason').val();
                    var symptom = $('#symptom').val();
                    var est_return = $('#est_return').val();
                    var scan_label = $('#scan_label').val();

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/borrow/takeout/') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            borrower: borrower,
                            lender: lender,
                            status: status,
                            dept: dept,
                            reason: reason,
                            symptom: symptom,
                            est_return: est_return,
                            scan_label: scan_label
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.success) {
                                swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton :false,
                                    timer: 300,

                                })
                                    var audio = document.getElementById('audio');
                                    var source = document.getElementById('audioSource');
                                    var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                    audio.load();
                                    audio.play();
                            } else {
                                swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    showConfirmButton :false,
                                    timer: 1000,
                                })
                                    var audio = document.getElementById('audio');
                                    var source = document.getElementById('audioSource');
                                    var audio = new Audio("{{asset('')}}storage/sound/mistake.mp3");
                                    audio.load()
                                    audio.play();
                            }

                            var data = ""
                            $.each(response.data, function(key, value) {

                                data = data + "<tr>"
                                data = data + "<td style=font-size:14px>" + value
                                    .custpo + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .partno + "</td>"
                                data = data + "<td style=font-size:14px>" + value.qty +
                                    "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .symptom + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .borrower + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .lender + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .dateout + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .status + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dept +
                                    "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .reason + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .est_return + "</td>"

                                data = data + "</tr>"
                            })
                            $('#borrow-takeout').html(data);
                           
                        }
                    });
                    $('#scan_label').val("");
                    $('#scan_label').focus();
                            
                }
            });



            //================================= STEP 2. START BORROW RETURN==================================
            $('#dic_return').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_dic_return = $('#dic_return').val();
                    if (val_dic_return != '') {

                        $('#receiver').attr('disabled', false);
                        $('#receiver').focus();
                    }
                }
            })


            $('#receiver').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_receiver = $('#receiver').val();
                    if (val_receiver != '') {

                        $('#remark').attr('disabled', false);
                        $('#remark').focus();
                    }
                }
            })

            $('#remark').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_remark = $('#remark').val();
                    if (val_remark != '') {

                        $('#label_kit').attr('disabled', false);
                        $('#label_kit').focus();
                    }
                }
            })

            $('#label_kit').on('keypress', function(e) {
                if (e.which == 13) {
                    var dic_return = $('#dic_return').val();
                    var receiver = $('#receiver').val();
                    var remark = $('#remark').val();
                    var label_kit = $('#label_kit').val();


                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/borrow/return/') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            dic_return: dic_return,
                            receiver: receiver,
                            remark: remark,
                            label_kit: label_kit
                        },
                        success: function(response) {

                            var data = ""
                            $.each(response.data, function(key, value) {

                                data = data + "<tr>"
                                if (value.tot_return == 0 && value.diff == 0) {
                                    data = data + "<tr class=table-light>";
                                }
                                if (value.tot_return != 0 && value.diff != 0) {
                                    data = data + "<tr class=table-warning>";
                                }
                                if (value.tot_return == value.qty && value.diff == 0) {
                                    data = data + "<tr class=table-success>";
                                }

                                data = data + "<td style=font-size:14px>" + value
                                    .custpo + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .partno + "</td>"
                                data = data + "<td style=font-size:14px>" + value.qty +
                                    "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .symptom + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .borrower + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .lender + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .dateout + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .status + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dept +
                                    "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .reason + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .est_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .act_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .dic_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .receiver + "</td>"
                                data = data + "<td style=font-size:14px>" + value
                                    .tot_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value.diff +
                                    "</td>"
                                data = data + "</tr>"
                            })
                            $('#borrow-return').html(data);
                            $('#label_kit').val("");
                            console.log(response)
                            if (response.success) {
                                swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton :false,

                                    timer: 300,


                                })
                                   var audio = document.getElementById('audio');
                                    var source = document.getElementById('audioSource');
                                    var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                    audio.load()
                                    audio.play();
                            } else {
                                swal.fire({
                                    icon: 'error',
                                    title: response.message,
                                    showConfirmButton :false,
                                    timer: 1000,

                                })
                                    var audio = document.getElementById('audio');
                                    var source = document.getElementById('audioSource');
                                    var audio = new Audio("{{asset('')}}storage/sound/mistake.mp3");
                                    audio.load()
                                    audio.play();

                                    let warningMessage = response.message;
                                    console.log("message",warningMessage.indexOf('BEFORE'))
                                    console.log("message",warningMessage.indexOf('DOUBLE'))
                                    if(warningMessage.indexOf('BEFORE') == 0){
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
                                                    $('#label_kit').focus();
                                                    $('#label_kit').val("");
                                                    return;
                                                  
                                    }

                                    if(warningMessage.indexOf('DOUBLE') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:100


                                        })

                                                    var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/double_scan.mp3");
                                                    audio.load()
                                                    audio.play();
                                                    $('#label_kit').focus();
                                                    $('#label_kit').val("");
                                                    return;

                                                   
                                    }
                                    
                                                    
                            }
                        }
                    })
                }
            })
        });
    </script>
@endsection
