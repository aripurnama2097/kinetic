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
        Problem History
      </a> --}}
    </div>
        <form  action ="{{url('user_setting/add')}}" method="post" class="card" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
            <h3 style="font-size:25px"class="card-title text-primary">ADD USER</h3>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="mb-3 col-6">
                    <label class="form-label required">User Name</label>
                    <div>
                      <input type="text" class="form-control"  name="name" id="name" placeholder="Enter NAME" required>
                    </div>
                </div>
                <div class="mb-3 col-6">
                    <label class="form-label required">User ID</label>
                    <div>
                      <input type="text" class="form-control"  name="nik" id="nik" placeholder="Enter NIK" required>
                    </div>
                </div>
                <div class="mb-3 col-6">
                    <label class="form-label required">User Password</label>
                    <div>
                      <input type="password" class="form-control"  name="password" id="password" placeholder="Enter Password" required>
                    </div>
                </div>
                {{-- <div class="mb-3 col-6">
                    <label class="form-label required">EMAIL</label>
                    <div>
                      <input type="email" class="form-control"  name="email" id="email" placeholder="Enter EMAIL" required>
                    </div>
                </div> --}}
                <div class="mb-3 col-6">
                    <label class="form-label required">LEVEL USER</label>
                    <select  class="form-control" name="role"  id="role" required> 
                        <option>--Select Level--</option>
                        <option>Admin Planning</option>
                        <option>Admin MC</option>
                        <option>Admin QA</option>    
                        <option>Admin QC</option>          
                    </select>
                </div>                           
                </div>
            </div>
           
          <div class="card-footer text-end">
            <button type = "submit"  class="btn btn-primary">Submit</button>
          </div>
        </form>

      <div class="card mt-2 mb-2 ">
        <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1 col-12 ">
          <table style="width:100%" id="problem-data"  class="table table-vcenter table-striped">
              <thead >
                  <tr class="headings">                   
                     
                      <th style="font-size: 13px;">Name</th>
                      <th style="font-size: 13px;">Nik</th>
                      <th style="font-size: 13px;">Level User</th>              
                      <th style="font-size: 13px;">Last Updated</th>
                      <th style="font-size: 13px;">Change</th>
                  

                  </tr>
              </thead>

              <tbody>
                  @foreach ($data as $key => $value)             
                  <td style="font-size: 13px;">{{ $value->name }}</td>
                  <td style="font-size: 13px;"> {{ $value->nik }}</td>
                  <td style="font-size: 13px;"> {{ $value->role }}</td>            
                  <td style="font-size: 13px;"> {{ $value->updated_at }}</td>
                  <td>
                    <a  class="btn btn-primary btn-sm text-white"  data-toggle="modal" data-target="#updateModal_{{$value->id}}"><i class="ti ti-edit"></i>Change</a>
                    <div class="modal modal-blur fade" id="updateModal_{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Change User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                         
                          <div class="modal-body">
                                <form  action="{{ url('user_setting/update/' . $value->id) }}"  method="POST" >
                                  @csrf
                              <div class="mb-3">
                                  <label class="form-label">User Name</label>
                                  <input type="text" name="name" class="form-control"  value="{{$value->name}}"  >
                              </div>
                            
                              <div class="mb-3">
                                  <label class="form-label">User ID </label>
                                  <input type="text" name="nik" class="form-control"  value="{{$value->nik}}"  >
                              </div>   
                              
                              {{-- <div class="mb-3">
                                <label class="form-label">User Password </label>
                                <input type="text"  class="form-control"  value="{{$value->password}}"  >
                             </div>   --}}

                             <div class="mb-3">
                              <label class="form-label required">LEVEL USER</label>
                              <select  class="form-control" name="role"  id="role" value="{{$value->role}}"required> 
                                  <option>--Select Level--</option>
                                  <option>Admin Planning</option>
                                  <option>Admin MC</option>
                                  <option>Admin QA</option>    
                                  <option>Admin QC</option>          
                              </select>
                            </div>  
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-link link-warning" data-bs-dismiss="modal">
                                  Cancel
                                </button>
                            <button type="submit" id="update" class="btn btn-primary ms-auto" >
                              Submit
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

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>

<script type="text/javascript">

    $(document).ready(function() {
     
       
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