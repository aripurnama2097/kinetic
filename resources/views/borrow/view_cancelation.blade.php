@extends('layouts.main')


@section('section')

<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-success">{{Session::get('success')}}</p>
  @endif

     <div class="col-md-12">
      <div class="col-md-12 mt-3 ml-0">
       
  
    </div>
        <form class="card">
        <div class="card-header">
          <h3 style="font-size:25px"class="card-title text-primary">PART CANCELATION</h3>
        </div>
        <div class="card-body">
          <div class="mb-3 col-12">
            <label class="form-label required">SCAN DIC(Planning)</label>
            <div>
              <input type="text" class="form-control" name="dic" id="dic" placeholder="SCAN NIK" required autofocus minlength="5">
              <small class="form-hint">          
              </small>
            </div>
          </div>


          <div class="mb-3 col-12"> 
            <label class="form-label required">SCAN LABEL</label>
            <div>
            <input type="text" class="form-control" name="label_kit" id="label_kit" placeholder="SCAN LABEL KIT" required disabled>
            <small class="form-hint">    
            </div>
          </div>


          <div class="mb-3 col-12"> 
            <label class="form-label required">INPUT QTY</label>
            <div>
            <input type="text" class="form-control" name="qty" id="qty" placeholder="INPUT QTY" required disabled>
            <small class="form-hint">    
            </div>
          </div>

          
          </form>
          </div>
        <div class="card-body border-bottom d-flex justify-content-center ">
          <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
            <table style="width:100%"  class="table table-vcenter table-striped">
                <thead >
                    <tr>                   
                      
                        <th style="font-size: 14px;">Custpo</th>
                        <th style="font-size: 14px;">Partno</th>
                        <th style="font-size: 14px;">Partname</th>
                        <th style="font-size: 14px;">Qty</th>
                        <th style="font-size: 14px;">DIC</th>                               
                    </tr>
                </thead>
                <tbody  id="cancelation">
                </tbody>
            </table>
          </div>
        </div>

{{-- END COLLAPSE BORROW RETURN --}}

     </div>
</div>

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
<script type="text/javascript">

    $(document).ready(function() {
  
        // STEP 1. START BORROW TAKE OUT
        $('#dic').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_dic = $('#dic').val();
                    if (val_dic != '') {
                     
                        $('#label_kit').attr('disabled', false);
                        $('#label_kit').focus();
                    }
                }
            })



              // STEP 1. START BORROW TAKE OUT
        $('#label_kit').on('keypress', function(e) {
                if (e.which == 13) {
                    var val_label_kit = $('#label_kit').val();
                    if (val_label_kit != '') {
                     
                        $('#qty').attr('disabled', false);
                        $('#qty').focus();
                    }
                }
            })


            $('#qty').on('keypress', function(e) {
                if (e.which == 13) {

                    var dic       = $('#dic').val();
                    var label_kit = $('#label_kit').val();
                    var qty = $('#qty').val();

                    
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('/borrow/cancelation/return') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                           dic:dic,
                           label_kit:label_kit,
                           qty:qty
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.success) {
                                swal.fire({
                                    icon: 'success',
                                    title: response.message,

                                    timer: 5000,
                                    

                                })
                            } else {
                                swal.fire({
                                    icon: 'error',
                                    title: response.message,

                                    timer: 5000,
                                    

                                })
                            }

                            var data = ""
                            $.each(response.data, function(key, value) {

                                data = data + "<tr>"
                                data = data + "<td style=font-size:14px>" + value.custpo + "</td>"
                                data = data + "<td style=font-size:14px>" + value.partno + "</td>"
                                data = data + "<td style=font-size:14px>" + value.partname+ "</td>"
                                data = data + "<td style=font-size:14px>" + value.qty + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dic + "</td>"
                              
                               
                                data = data + "</tr>"
                              })
                              $('#cancelation').html(data); 
                                $('#qty').val("");
                        }
                    });

                }
            })

         


         
}); 


</script>
@endsection