@extends('layouts.main')


@section('section')

<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-success">{{Session::get('success')}}</p>
  @endif

     <div class="col-md-12">
      <div class="col-md-12 mt-3">
      {{-- <a href="#" class="btn btn-light mb-3 btn-sm" data-bs-toggle="modal" data-bs-target="#stdpack-upload"><i class="ti ti-user-plus"></i>
        Add User
      </a>

      <a href="{{url('problem/view')}}" class="btn btn-success mb-3 btn-sm" ><i class="ti ti-ban"></i>
        In House Monitoring
      </a> --}}
      <div class="btn-group col-12 mt-2 mb-2" role="group">
        <a class="btn btn-primary col-6 text-white" id="btn_scan_qr" role="button"
        aria-expanded="false" aria-controls="scan_qr">
          Scan QR <i class="ti ti-qrcode"></i>
        </a>

        <a class="btn btn-light col-6" id="btn_input_data" role="button"
        aria-expanded="false" aria-controls="input_data" ><i class="ti ti-ballpen"></i>
          Input Data
        </a>
    </div>
    </div>

    <div class="collapse mt-4" id="scan_qr" hide>
        {{-- <form  action ="{{url('partlist/inhouse/scanin')}}" method="post" class="card" enctype="multipart/form-data">
          @csrf --}}
          <div class="card">
          <div class="card-header">
            <h3 style="font-size:25px"class="card-title text-primary">SCAN QR INHOUSE</h3>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label required">PIC</label>
              <div>
                <input type="text" class="form-control"  name="pic" id="pic" placeholder="Enter NIK" required focus>
                <small class="form-hint">input nik pic</small>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label required">SCAN LABEL</label>
              <div>
                <input type="text" class="form-control" name="assy_label" id="assy_label" placeholder="SCAN LABEL" required disabled>
                <small class="form-hint">
                </small>
              </div>
            </div>
          </div>
        </div>
        {{-- </form> --}}
        <div class="card-body border-bottom d-flex justify-content-center ">
          <div class="table-responsive  rounded-1 shadow-sm col-12 ">

              <table style="width:100%"
                  class="text-nowrap  table border-bordered border border-primary shadow-sm">
                  <thead class="thead-dark">
                      <tr>
                          {{-- <th style="font-size: 10px;">No</th> --}}
                          <th style="font-size: 10px;">Model</th>
                          <th style="font-size: 10px;">Prod No</th>
                          <th style="font-size: 10px;">Demand</th>
                          <th style="font-size: 10px;">JKN PO</th>

                          <th style="font-size: 10px;">Total Scan</th>
                          <th style="font-size: 10px;">Balance Scan</th>
                      </tr>
                  </thead>

                  <tbody id="scan-assy">
                  </tbody>
              </table>
          </div>
          <br>
          <br>
      </div>
    </div>

    <div class="collapse mt-4" id="input_data" hide>
        {{-- <form  action ="{{url('partlist/inhouse/input_inhouse')}}" method="post" class="card" enctype="multipart/form-data">
          @csrf --}}
        <div class="card">
          <div class="card-header">
            <h3 style="font-size:25px"class="card-title text-primary">INPUT DATA INHOUSE</h3>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label required">PIC</label>
              <div>
                <input type="text" class="form-control"  name="pic" id="pic" placeholder="Enter NIK" required>
                <small class="form-hint">input nik pic</small>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label required">MODEL</label>
              <div>
                <input type="text" class="form-control" name="model" id="model" placeholder="INPUT MODEL" required>
                <small class="form-hint">

                </small>
              </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">PROD NO</label>
                <div>
                  <input type="text" class="form-control" name="lotno" id="lotno" placeholder="PRODNO" required>
                  <small class="form-hint">

                  </small>
                </div>
              </div>


              <div class="mb-3">
                <label class="form-label required">QTY</label>
                <div>
                  <input type="text" class="form-control" name="qty" id="qty" placeholder="QTY" required>
                </div>
              </div>

             

              {{-- <div class="mb-3">
                <div>
                <label class="form-label required">PO</label>
                <select style="font-size:15px" class="form-control " id="po" name="po">
                    <option value="-">-- ALOKASI PO --</option>
                    @foreach ($datapo as $dd)
                    <option value="{{ $dd->jknpo }}">{{ $dd->jknpo }}</option>
                    @endforeach
                </select>
                </div>
              </div> --}}

          </div>
          <div class="card-footer text-end">
            <button onclick="input_inhouse()" type = "submit"  class="btn btn-primary">Submit</button>
          </div>
          <div class="card-body border-bottom d-flex justify-content-center ">
            <div class="table-responsive  rounded-1 shadow-sm col-12 ">

                <table style="width:100%"
                    class="text-nowrap  table border-bordered border border-primary shadow-sm">
                    <thead class="thead-dark">
                        <tr>
                            {{-- <th style="font-size: 10px;">No</th> --}}
                            <th style="font-size: 10px;">Model</th>
                            <th style="font-size: 10px;">Prod No</th>
                            <th style="font-size: 10px;">Demand</th>
                            <th style="font-size: 10px;">JKN PO</th>

                            <th style="font-size: 10px;">Total Scan</th>
                            <th style="font-size: 10px;">Balance Scan</th>
                        </tr>
                    </thead>

                    <tbody id="scan-assyInput">
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

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
<script type="text/javascript">

    $(document).ready(function() {
      $('#problem-data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5'
        ]
      });


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
          if (e.which == 13) {
            var pic = $('#pic').val();
            var assy_label = $('#assy_label').val();
            $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('partlist/inhouse/scanin') }}",
                    data: {
                        pic : pic,
                        assy_label :assy_label,
                        _token: '{{ csrf_token() }}'
                    },

                    success: function(response) {
                        var data = ""
                        $.each(response.data, function(key, value) {
                        data = data + "<tr>"
                        if (value.tot_input == 0 && value.balance == 0) {
                            data = data + "<tr class=table-light>";
                        }
                        if (value.tot_input != 0 && value.balance != 0) {
                            data = data + "<tr class=table-warning>";
                        }
                        if (value.tot_input == value.shipqty && value
                            .balance == 0) {
                            data = data + "<tr class=table-success>";
                        }

                        // data = data + "<td>" + value.id + "</td>"
                        data = data + "<td>" + value.model + "</td>"
                        data = data + "<td>" + value.lotno + "</td>"
                        data = data + "<td>" + value.shipqty + "</td>"
                        data = data + "<td>" + value.jknpo + "</td>"
                        data = data + "<td>" + value.tot_input + "</td>"
                        data = data + "<td>" + value.balance + "</td>"


                        data = data + "</tr>"
                        $('#scan-assy').html(data);

                        })

                        if (response.success) {
                                    var audio   = document.getElementById('audio');
                                    var source  = document.getElementById('audioSource');
                                    var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                    audio.load()
                                    audio.play();

                                // swal.fire({
                                //     icon: 'success',
                                //     title: response.message,
                                //     showConfirmButton :false,
                                //     // timer:2000

                                // })
                                $('#assy_label').val("");
                                }
                                else {
                                    swal.fire({
                                    icon: 'warning',
                                    title: response.message,
                                    showConfirmButton :false
                                })

                                let warningMessage = response.message;
                             
                             console.log("message",warningMessage.indexOf('OVER'))
                             console.log("message",warningMessage.indexOf('DOUBLE'))


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
                                                audio.load()
                                                audio.play();
                                                

                                    return;
                                    $('#assy_label').val("");
                                }


                                if(warningMessage.indexOf('DOUBLE') == 0){
                                        Swal.fire({

                                            icon: 'warning',
                                            title: response.message,
                                            showConfirmButton :false,
                                            timer:300


                                        })


                                        var audio = document.getElementById('audio');
                                                    var source = document.getElementById('audioSource');
                                                    var audio = new Audio("{{asset('')}}storage/sound/double_scan.mp3");
                                                    audio.load()
                                                    audio.play();
                                                    return;

                                        return;
                                        $('#assy_label').val("");
                                    }



                                }
                                $('#assy_label').val("");
                    }
                })
        }
    })

    $('#btn_scan_qr').on('click', function(){
        $('#input_data').hide();
        $('#scan_qr').show();
    })
    $('#btn_input_data').on('click', function(){
        $('#scan_qr').hide();
        $('#input_data').show();
    })

});


          function input_inhouse(){
                            var pic = $('#pic').val();
                            var model = $('#model').val();
                            var lotno = $('#lotno').val();
                            var qty = $('#qty').val();
                      
                            $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url:  "{{url('partlist/inhouse/input_inhouse')}}",
                                    data: {
                                      pic : pic,
                                      model : model,
                                      lotno : lotno,
                                      qty : qty,
                                           
                                        _token: '{{ csrf_token() }}'
                                    },

                                    success: function(response) {
                                      var data = ""
                                      $.each(response.data, function(key, value) {
                                      data = data + "<tr>"
                                        if (value.tot_input == 0 && value.balance == 0) {
                                            data = data + "<tr class=table-light>";
                                        }
                                        if (value.tot_input != 0 && value.balance != 0) {
                                            data = data + "<tr class=table-warning>";
                                        }
                                        if (value.tot_input == value.shipqty && value
                                            .balance == 0) {
                                            data = data + "<tr class=table-success>";
                                        }

                                        // data = data + "<td>" + value.id + "</td>"
                                        data = data + "<td>" + value.model + "</td>"
                                        data = data + "<td>" + value.lotno + "</td>"
                                        data = data + "<td>" + value.shipqty + "</td>"
                                        data = data + "<td>" + value.jknpo + "</td>"
                                        data = data + "<td>" + value.tot_input + "</td>"
                                        data = data + "<td>" + value.balance + "</td>"


                                        data = data + "</tr>"
                                        $('#scan-assyInput').html(data);

                                      })
                                      if (response.success) {
                                                    var audio   = document.getElementById('audio');
                                                    var source  = document.getElementById('audioSource');
                                                    var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
                                                    audio.load()
                                                    audio.play();
                                                swal.fire({
                                                    icon: 'success',
                                                    title: response.message,

                                                    showConfirmButton :false,
                                                 

                                                })
                                                }
                                      else {
                                                    swal.fire({
                                                    icon: 'warning',
                                                    title: response.message
                                                })

                                                let warningMessage = response.message;
                             
                                                 console.log("message",warningMessage.indexOf('OVER'))

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
                                       }

                                    }
                            })
                    }


</script>
@endsection
