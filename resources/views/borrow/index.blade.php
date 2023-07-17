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
                  <option>QA</option>
                  <option>IQC</option>
                  <option>Planning</option>          
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
              <select  class="form-control" name="symptom"  id="symptom" required disabled> 
                 <option>--Select Symptom--</option>
                  <option>Shipment Hold</option>
                  <option>WIP</option>
                  <option>Conditional Acceptance</option>
                  <option>Lot Out</option>
              </select>
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
    </div>


    <div class="collapse mt-4" id="return" hide>
      <form  action ="{{url('problem/create')}}" method="post" class="card" enctype="multipart/form-data">
        @csrf
        <div class="card-header">
          <h3 style="font-size:25px"class="card-title text-primary">Borrow Return</h3>
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
                <option>QA</option>
                <option>IQC</option>
                <option>Planning</option>          
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
            <select  class="form-control" name="symptom"  id="symptom" required disabled> 
               <option>--Select Symptom--</option>
                <option>Shipment Hold</option>
                <option>WIP</option>
                <option>Conditional Acceptance</option>
                <option>Lot Out</option>
            </select>
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
  </div>

      {{-- <div class="card mt-2 mb-2">
        <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
          <table style="width:100%" id="problem-data"  class="table table-vcenter table-striped">
              <thead >
                  <tr class="headings">                   
                     
                      <th style="font-size: 10px;">reason</th>
                      <th style="font-size: 10px;">Model</th>
                      <th style="font-size: 10px;">Prod No</th>
                   
                      <th style="font-size: 10px;">VanDate</th>
                 
                      <th style="font-size: 10px;">Cust PO</th>
                      <th style="font-size: 10px;">Part Number</th>
                      <th style="font-size: 10px;">Part Name</th>
                      <th style="font-size: 10px;">Demand</th>
                      <th style="font-size: 10px;">Skid No</th>
                      <th style="font-size: 10px;">Symptom</th>

                      <th style="font-size: 10px;">Foto</th>
                      <th style="font-size: 10px;">Time Found</th>
                      <th style="font-size: 10px;">Found By</th>
                      <th style="font-size: 10px;">DIC</th>
                      <th style="font-size: 10px;">Cause</th>
                      <th style="font-size: 10px;">Action</th>
                      <th style="font-size: 10px;">Last Updated</th>
                  

                  </tr>
              </thead>

              <tbody>
                  @foreach ($data as $key => $value)             
                  <td style="font-size: 12px;">{{ $value->dest }}</td>
                  <td style="font-size: 12px;"> {{ $value->model }}</td>
                  <td style="font-size: 12px;"> {{ $value->prodno }}</td> 
               
                  <td style="font-size: 12px;"> {{ $value->vandate }}</td>
           
                  <td style="font-size: 12px;">{{ $value->custpo }} </td>
                  <td style="font-size: 12px;">{{ $value->partno }} </td>
                  <td style="font-size: 12px;">{{ $value->partname }} </td>
                  <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                  <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->skid_no }}</td> 
                  <td style="font-size: 12px;"> {{ $value->symptom }}</td>
                  <td style="font-size: 12px;"><img width="30%" class="img-circle" src="{{ url('/public/img') }}"> </td>
                  <td style="font-size: 12px;">{{$value->created_at}}</td>
                  <td style="font-size: 12px;"></td>           
                  <td style="font-size: 12px;"> </td>
                  <td style="font-size: 12px;"> </td>
                  <td class="text-primary text-center"   style="font-size: 14px; font-weight:bold"> </td>
                  <td class="text-danger text-center" style="font-size: 14px;"> </td> 
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div> --}}
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



        // START PRINT SKID
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


               //STEP 2. SCAN LABEL MC 
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
                            $.each(response, function(key, value) {

                                // dataScan = dataScan + "<tr>"
                                // if (value.tot_scan == 0 && value.balance_issue == 0) {
                                //     dataScan = dataScan + "<tr class=table-light>";
                                // }
                                // if (value.tot_scan != 0 && value.balance_issue != 0) {
                                //     dataScan = dataScan + "<tr class=table-warning>";
                                // }
                                // if (value.tot_scan == value.demand && value
                                //     .balance_issue == 0) {
                                //     dataScan = dataScan + "<tr class=table-success>";
                                // }

                                // dataScan = dataScan + "<td>" + value.id + "</td>"
                                // dataScan = dataScan + "<td>" + value.custcode + "</td>"
                                // dataScan = dataScan + "<td>" + value.prodno + "</td>"
                                // dataScan = dataScan + "<td>" + value.partno + "</td>"
                                // dataScan = dataScan + "<td>" + value.partname + "</td>"
                                // dataScan = dataScan + "<td>" + value.demand + "</td>"
                                // dataScan = dataScan + "<td>" + value.tot_scan + "</td>"
                                // dataScan = dataScan + "<td>" + value.balance_issue +
                                //     "</td>"

                                // dataScan = dataScan + "</tr>"
                            })
                            // $('#data-scanin').html(dataScan);
                            $('#scan_label').focus();
                            $('#scan_label').val("");
                        }
                    });
                }
            });

       
}); 


</script>
@endsection