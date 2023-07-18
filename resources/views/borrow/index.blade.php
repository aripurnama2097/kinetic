@extends('layouts.main')


@section('section')

<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-success">{{Session::get('success')}}</p>
  @endif

     <div class="col-md-12">
      <div class="col-md-12 mt-3 ml-0">
        <div class="btn-group col-12 mt-5" role="group">
          <a class="btn btn-primary col-6" data-bs-toggle="collapse" href="#take_out" role="button"
          aria-expanded="false" aria-controls="take_out">
            Borrow Takeout <i class="ti ti-arrow-bar-right"></i>
          </a>
    
          <a class="btn btn-success col-6" data-bs-toggle="collapse" href="#return" role="button"
          aria-expanded="false" aria-controls="return" ><i class="ti ti-arrow-bar-left"></i>
            Borrow Return
          </a>
        </div>
        {{-- <div class="btn-group" role="group">
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
          </div>
      </div> --}}
   
    </div>
    <div class="collapse mt-4" id="take_out" hide>
        <form  action ="{{url('problem/create')}}" method="post" class="card" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
            <h3 style="font-size:25px"class="card-title text-primary">Borrow Take Out</h3>
          </div>
          <div class="card-body">
        
            <div class="row">
            <div class="mb-3 col-6">
              <label class="form-label required">SCAN DIC(Borrower)</label>
              <div>
                <input type="text" class="form-control" name="borrower" id="borrower" placeholder="SCAN NIK" required autofocus minlength="5">
                <small class="form-hint">          
                </small>
              </div>
            </div>

            <div class="mb-3 col-6">
              <label class="form-label required">Reason</label>
              <select  class="form-control" name="reason"  id="reason" required disabled> 
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
                <input type="text" class="form-control" name="lender" id="lender" placeholder="SCAN NIK" required disabled>
                <small class="form-hint">           
                </small>
              </div>
            </div>

            <div class="mb-3 col-6">
              <label class="form-label required">Symptom</label>
              <div>
                <input type="text" class="form-control" name="symptom" id="symptom" placeholder="SYMPTOM" required disabled>
                <small class="form-hint">           
                </small>
              </div>
            </div>

            <div class="mb-3 col-6">
              <label class="form-label required">Status</label>
              <select  class="form-control" name="status"  id="status" required disabled> 
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
                <input type="date" class="form-control" name="est_return" id="est_return" placeholder="EST RETURN" required disabled>
                <small class="form-hint">           
                </small>
              </div>
            </div>

            <div class="mb-3 col-6">
              <label class="form-label required">Dept</label>
              <select  class="form-control" name="dept"  id="dept" required disabled> 
                  <option>--Select Dept--</option>
                  <option>QA</option>
                  <option>IQC</option>
                  <option>Planning</option>
                
              </select>
            </div>

            <div class="mb-3 col-6"> 
              <label class="form-label required">SCAN LABEL</label>
              <input type="text" class="form-control" name="scan_label" id="scan_label" placeholder="SCAN LABEL KIT" required disabled>
              <small class="form-hint">    
            </div>
          </div>
          </div>
        </form>

        <div class="card-body border-bottom d-flex justify-content-center ">
          <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
            <table style="width:100%"  class="table table-vcenter table-striped">
                <thead >
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
                <tbody  id="borrow-takeout">
                </tbody>
            </table>
          </div>
        </div>
    </div>


    <div class="collapse mt-4" id="return" >
        <form class="card">
        <div class="card-header">
          <h3 style="font-size:25px"class="card-title text-primary">Borrow Return</h3>
        </div>
        <div class="card-body">
          <div class="mb-3 col-12">
            <label class="form-label required">SCAN DIC(Return)</label>
            <div>
              <input type="text" class="form-control" name="dic_return" id="dic_return" placeholder="SCAN NIK" required autofocus minlength="5">
              <small class="form-hint">          
              </small>
            </div>
          </div>

          
          <div class="mb-3 col-12">
            <label class="form-label required">SCAN PIC (Receiver)</label>
            <div>
              <input type="text" class="form-control" name="receiver" id="receiver" placeholder="SCAN NIK" required disabled>
              <small class="form-hint">           
              </small>
            </div>
          </div>

          
          <div class="mb-3 col-12"> 
            <label class="form-label ">REMARK</label>
            <div>
              <input type="text" class="form-control" name="remark" id="remark" placeholder="REMARK"  disabled>
              <small class="form-hint">    
            </div>
          </div>

          <div class="mb-3 col-12"> 
            <label class="form-label required">SCAN LABEL</label>
            <div>
            <input type="text" class="form-control" name="label_kit" id="label_kit" placeholder="SCAN LABEL KIT" required disabled>
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
                <tbody  id="borrow-return">
                </tbody>
            </table>
          </div>
        </div>
  </div>
{{-- END COLLAPSE BORROW RETURN --}}

     </div>
</div>

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
<script type="text/javascript">

    $(document).ready(function() {
  
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
                    }
                }
            })

            $('#status').on('keypress', function(e) {
                // if (e.which == 13) {
                    var val_status = $('#status').val();
                    if (val_status != '') {
                     
                        $('#dept').attr('disabled', false);
                        $('#dept').focus();
                    }
                // }
            })


            $('#dept').on('click', function(e) {
                    var val_dept = $('#dept').val();  
                    if (val_dept != '') {                  
                        $('#reason').attr('disabled', false);
                        $('#reason').focus();
                    }
            })

            $('#reason').on('click', function(e) {
                   var val_reason = $('#reason').val();  
                    if (val_reason != '') {                  
                        $('#symptom').attr('disabled', false);
                        $('#symptom').focus();
                    }
            })

            $('#symptom').on('click', function(e) {
                   var val_symptom = $('#symptom').val();  
                    if (val_symptom != '') {                  
                        $('#est_return').attr('disabled', false);
                        $('#est_return').focus();
                    }
            })

      
            $('#est_return').on('click', function(e) {
                    var val_est_return = $('#est_return').val();
                    if (val_est_return != '') {                  
                     $('#scan_label').attr('disabled', false);
                     $('#scan_label').focus();
                    
                    }
                   
             });


            
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
                           borrower:borrower,
                           lender:lender,
                           status:status,
                           dept: dept,
                           reason: reason,
                           symptom: symptom,
                           est_return:est_return,
                           scan_label:scan_label
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
                                data = data + "<td style=font-size:14px>" + value.qty + "</td>"
                                data = data + "<td style=font-size:14px>" + value.symptom + "</td>"
                                data = data + "<td style=font-size:14px>" + value.borrower + "</td>"
                                data = data + "<td style=font-size:14px>" + value.lender + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dateout + "</td>"
                                data = data + "<td style=font-size:14px>" + value.status + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dept + "</td>"
                                data = data + "<td style=font-size:14px>" + value.reason + "</td>"
                                data = data + "<td style=font-size:14px>" + value.est_return + "</td>"
                               
                                data = data + "</tr>"
                              })
                                $('#borrow-takeout').html(data);  
                                $('#scan_label').focus();
                                $('#scan_label').val("");
                        }
                    });
                }
            });



              //================================= STEP 2. START BORROW TAKE OUT==================================
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
                              dic_return:dic_return,
                              receiver:receiver,
                              remark:remark,
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

                                data = data + "<td style=font-size:14px>" + value.custpo + "</td>"
                                data = data + "<td style=font-size:14px>" + value.partno + "</td>"
                                data = data + "<td style=font-size:14px>" + value.qty + "</td>"
                                data = data + "<td style=font-size:14px>" + value.symptom + "</td>"
                                data = data + "<td style=font-size:14px>" + value.borrower + "</td>"
                                data = data + "<td style=font-size:14px>" + value.lender + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dateout + "</td>"
                                data = data + "<td style=font-size:14px>" + value.status + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dept + "</td>"
                                data = data + "<td style=font-size:14px>" + value.reason + "</td>"
                                data = data + "<td style=font-size:14px>" + value.est_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value.act_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value.dic_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value.receiver + "</td>"
                                data = data + "<td style=font-size:14px>" + value.tot_return + "</td>"
                                data = data + "<td style=font-size:14px>" + value.diff + "</td>"
                                data = data + "</tr>"
                            })
                                $('#borrow-return').html(data);  
                                $('#label_kit').val("");                 
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
                          }      
                        })
                      }
                    })  
}); 


</script>
@endsection