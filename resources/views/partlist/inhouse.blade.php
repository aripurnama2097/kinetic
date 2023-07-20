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
        <a class="btn btn-primary col-6" data-bs-toggle="collapse" href="#scan_qr" role="button"
        aria-expanded="false" aria-controls="scan_qr">
          Scan QR <i class="ti ti-qrcode"></i>
        </a>
  
        <a class="btn btn-light col-6" data-bs-toggle="collapse" href="#input_data" role="button"
        aria-expanded="false" aria-controls="input_data" ><i class="ti ti-ballpen"></i>
          Input Data
        </a>
    </div>
    </div>
   
    <div class="collapse mt-4" id="scan_qr" hide>
        <form  action ="{{url('partlist/inhouse/scanin')}}" method="post" class="card" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
            <h3 style="font-size:25px"class="card-title text-primary">INPUT DATA INHOUSE</h3>
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
        </form>
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

              <div class="mb-3">
                <label class="form-label required">PO</label>
                <div>
                  <input type="text" class="form-control" name="jknpo" id="jknpo" placeholder="QTY" required>          
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
        {{-- </form> --}}
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
                              if (response.success) {
                                            var audio   = document.getElementById('audio');
                                            var source  = document.getElementById('audioSource');
                                            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");

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
                                        $('#assy_label').val("");
                            }
                        })    
            })   
}); 


          function input_inhouse(){
                            var pic = $('#pic').val();
                            var model = $('#model').val();
                            var lotno = $('#lotno').val();
                            var qty = $('#qty').val();
                            var jknpo = $('#jknpo').val();
                            $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url:  "{{url('partlist/inhouse/input_inhouse')}}",
                                    data: {
                                      pic : pic,
                                      model : model,                      
                                      lotno : lotno,
                                      qty : qty,
                                      jknpo : jknpo,
                                        _token: '{{ csrf_token() }}'
                                    },
                              
                                    success: function(response) {                  
                                      if (response.success) {
                                                    var audio   = document.getElementById('audio');
                                                    var source  = document.getElementById('audioSource');
                                                    var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");

                                                swal.fire({
                                                    icon: 'success',
                                                    title: response.message,

                                                    timer: 5000,
                                                   

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
                    }  
   
  
</script>
@endsection