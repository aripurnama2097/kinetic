@extends('layouts.main')


@section('section')

<div class="container">
  @if(Session::has('success'))
  <p class="alert alert-success">{{Session::get('success')}}</p>
  @endif

     <div class="col-md-12">
      <div class="col-md-12 mt-3">
      <a href="#" class="btn btn-light mb-3 btn-sm" data-bs-toggle="modal" data-bs-target="#stdpack-upload"><i class="ti ti-user-plus"></i>
        Add User
      </a>

      <a href="{{url('problem/view')}}" class="btn btn-success mb-3 btn-sm" ><i class="ti ti-ban"></i>
        Problem History
      </a>
    </div>
        <form  action ="{{url('problem/create')}}" method="post" class="card" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
            <h3 style="font-size:25px"class="card-title text-primary">PROBLEM FOUND</h3>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label required">PIC</label>
              <div>
                <input type="text" class="form-control"  name="found_by" id="found_by" placeholder="Enter NIK" required>
                <small class="form-hint">input nik pic</small>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label required">SCAN LABEL</label>
              <div>
                <input type="text" class="form-control" name="label_kit" id="label_kit" placeholder="SCAN LABEL" required>
                <small class="form-hint">
                
                </small>
              </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">SYMPTOM</label>
                <div>
                  <input type="text" class="form-control" name="symptom" id="symptom" placeholder="SYMPTOM" required>
                  <small class="form-hint">
                   
                  </small>
                </div>
              </div>
          
            <div class="mb-3">
                <label class="form-label">PICTURE</label>
                <div>
                  <input type="file" class="form-control" name="image"  >
                 
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label required">DIC</label>
                <div>
                  <input type="email" class="form-control" name="dic" placeholder="INPUT DIC" required>          
                </div>
              </div>
          </div>
          <div class="card-footer text-end">
            <button type = "submit"  class="btn btn-primary">Submit</button>
          </div>
        </form>

      {{-- <div class="card mt-2 mb-2">
        <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1">
          <table style="width:100%" id="problem-data"  class="table table-vcenter table-striped">
              <thead >
                  <tr class="headings">                   
                     
                      <th style="font-size: 10px;">Dest</th>
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
       
}); 


      // function create(){
        //     var found_by= $('#found_by').val();
        //     var label_kit = $('#label_kit').val();
        //     var symptom = $('#symptom').val()
        //     var file = $('#file').val()

        //             $.ajax({
        //                   url: "{{ url('/problem/create/') }}",
        //                   method: 'POST',
        //                   data: {
        //                       prodno: prodNo,
        //                       _token: '{{ csrf_token() }}'
        //                   },
        //                   success: function(response) {
        //                       var data = ""
        //                       console.log(data);
        //                   }
        //               });
        // }
</script>
@endsection