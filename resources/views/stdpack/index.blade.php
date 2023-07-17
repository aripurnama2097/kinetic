@extends('layouts.main')



@section('section')



<div class="page-wrapper">
 
  
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
              Overview
            </div>
            <h2 class="page-title">
              Standard Pack
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <button  id="delete-all-data" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> Reset Master</button>
              <span class="d-none d-sm-inline">
                <a href="#" class="btn btn-light " data-bs-toggle="modal" data-bs-target="#stdpack-upload"> <i class="ti ti-arrow-big-down-filled"></i>
                  Upload Std Pack
                </a>
              </span>
              <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#create-stdpack">
                <i class="ti ti-plus"></i>
                Create Std Pack
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl ">
        <div class="card card-lg">
         
        
             

             
              <div class="card-body border-bottom py-2">
               
                @if(Session::has('success'))
                <p class="alert alert-success">{{Session::get('success')}}</p>
                @endif

                <a href="{{url('/stdpack')}}" class="btn btn-info d-none d-sm-inline-block btn-sm " >
                  <i class="ti ti-360"></i>
                  Refresh
                </a>

            
                <br>
                <br>
                <div class="table-responsive  rounded-1">
                  <table id="schedule-release" class="table table-bordered yajra-datatable">
                    <thead class="thead-dark">
                      <tr>
                      
                        <th> No </th>
                        <th>Part Number</th>
                        <th>Part Name</th>
                        <th>Lenght</th>
                        <th>Widht</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Pack</th>
                        <th>Vendor</th>
                        <th>JKN Shelf No</th>         
                        {{-- <th>Action</th>  --}}

                        
                      
                      </tr>
                    </thead>
                    <tbody>
                      {{-- @foreach($data as $key => $value)
                      <tr>
                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                        <td> {{$value->partnumber}}</td>
                        <td > {{$value->partname}}</td>
                        <td> {{$value->lenght}}</td>
                        <td> {{$value->widht}}</td>
                        <td> {{$value->height}}</td>
                        <td> {{$value->weight}}</td>
                        <td> {{$value->stdpack}}</td>
                        <td> {{$value->vendor}}</td>
                        <td> {{$value->jknshelf}}</td>
                       
                        <td class="btn-group"> 
                         
                           <form  action="{{url('/stdpack/'.$value->id. '/destroy')}}" onclick="return confirm('Delete This data?')" method="GET" >
                            @method('delete')
                            @csrf							
                            <input type="hidden" name="s_method" value="DELETE">
                            <button type="submit" class="btn btn-danger  btn-sm" ></i>Delete</button> 
                          </form>	

                          <a  class="btn btn-primary btn-sm text-white"  data-toggle="modal" data-target="#updateModal_{{$value->id}}">Edit</a>
                        
                          <div class="modal modal-blur fade" id="updateModal_{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Update Std Pack</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                               
                                    <div class="modal-body">
                                      <form  action="{{ url('stdpack/update/' . $value->id) }}"  method="POST" >
                                        @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Item Number</label>
                                        <input type="text" name="partnumber" id="partnumber" class="form-control"  value="{{$value->partnumber}}" placeholder="PART NUMBER">
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                            <label class="form-label">Part Name</label>
                                            <input type="text" class="form-control" name="partname" value="{{$value->partname}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                            <label class="form-label">Lenght</label>
                                            <input type="text" class="form-control"  name="lenght" value="{{$value->lenght}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                            <label class="form-label">Widht</label>
                                            <input type="text" class="form-control" name="widht" value="{{$value->widht}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <label class="form-label">Height</label>
                                                <input type="text" class="form-control" name="height" value="{{$value->height}}" required>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg-6">
                                            <div>
                                            <label class="form-label">Weight</label>
                                            <input type="text" class="form-control" name="weight"  value="{{$value->weight}}"required>
                                            </div>
                                        </div>
                                      
                                        <br>
                                        <br>
                                        <div class="col-lg-6">
                                            <div>
                                            <label class="form-label">Pack</label>
                                            <input type="text" class="form-control"name="stdpack"  value="{{$value->stdpack}}"required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-lg-6">
                                            <div>
                                            <label class="form-label">Vendor</label>
                                            <input type="text" class="form-control" name="vendor" value="{{$value->vendor}}" required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-lg-6">
                                            <div>
                                            <label class="form-label">JKN Shelf No</label>
                                            <input type="text" class="form-control"  name="jknshelf" value="{{$value->jknshelf}}" required>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                       
                                       
                                    </div>  
                        
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-light link-warning" data-bs-dismiss="modal">
                                        Cancel
                                      </button>
                                      <button type="submit" id="update" class="btn btn-primary ms-auto" >
                                        Update
                                      </button>
                                  </div>
                                </form>
                                    </div>
                        
                               
                              
                              
                              </div>
                            </div>
                          </div>
                        
                        </td>
                       
                       
                      </tr> --}}
                      {{-- @endforeach --}}
                     
                  
                    </tbody>
                  </table>
                </div>
                {{-- <div class="d-flex justify-content-center">
                            {{ $data->links() }}
                </div> --}}
              </div>
           
              <div class="card-footer d-flex align-items-center">
              </div>
            </div>
          </div>
       
    </div>
  
  </div>


  {{-- ====================,modal stdpack upload ========================================= --}}
<div class="modal modal-blur fade" id="stdpack-upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Std pack Upload</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form  action="{{url('/stdpack/upload-stdpack')}}"  enctype="multipart/form-data" method="POST" >
            @csrf  
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Upload file</label>
                    <input  type="file" class="form-control" rows="3" name="file"  id="file" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button shadow-lg" class="btn btn-light link-warning" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit" href="#" class="btn btn-primary ms-auto" >
                <i class="ti ti-plus"></i>
                Upload stdpack
              </button>
            </div>
          </form>
        </div>
    </div>
</div>


<div class="modal modal-blur fade" id="create-stdpack" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Std Pack</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
            <div class="modal-body">
              <form  action="{{url('/stdpack/create')}}"  method="POST" >
                @csrf
            <div class="mb-3">
                <label class="form-label">Item Number</label>
                <input type="text" name="partnumber" class="form-control" name="example-text-input" placeholder="PART NUMBER">
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                    <label class="form-label">Part Name</label>
                    <input type="text" class="form-control" name="partname" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                    <label class="form-label">Lenght</label>
                    <input type="text" class="form-control"  name="lenght" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Widht</label>
                    <input type="text" class="form-control" name="widht" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">Height</label>
                        <input type="text" class="form-control" name="height" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Weight</label>
                    <input type="text" class="form-control" name="weight" required>
                    </div>
                </div>
              
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Pack</label>
                    <input type="text" class="form-control"name="stdpack" required>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">Vendor</label>
                    <input type="text" class="form-control" name="vendor" required>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-6">
                    <div>
                    <label class="form-label">JKN Shelf No</label>
                    <input type="text" class="form-control"  name="jknshelf" required>
                    </div>
                </div>
                <br>
                <br>
                
                <br>
                <br>
            </div>  

            <div class="modal-footer">
              <button type="button shadow-lg" class="btn btn-light link-warning" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit"  class="btn btn-primary ms-auto" >
                Create new stdpack
              </button>
          </div>
        </form>
            </div>

       
      
      
      </div>
    </div>
  </div>




<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript" src="{{asset('')}}js/TableCheckAll.js"> </script>

<script type="text/javascript">
  $(document).ready(function() {
    // $('#schedule-release').DataTable( {
    //     // dom: 'Bfrtip',
    //     buttons: [
           
    //         'excelHtml5',
    //         'csvHtml5'
    //     ]
    // } );

    // <th> No </th>
    //                     <th>Part Number</th>
    //                     <th>Part Name</th>
    //                     <th>Lenght</th>
    //                     <th>Widht</th>
    //                     <th>Height</th>
    //                     <th>Weight</th>
    //                     <th>Pack</th>
    //                     <th>Vendor</th>
    //                     <th>JKN Shelf No</th>
    //                     <th>MC Shelf No</th>
    //                     <th>Action</th>


    // $('#tbl_data').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     url: "{{url('/stdpack')}}",
        
    //     columns: [
    //         { data: 'id', name: 'id' },
    //         { data: 'partnumber', name: 'partnumber' },
    //         { data: 'partname', name: 'partname' },

    //     ]
    // });

    // $("#example").TableCheckAll();

    $('#delete-all-data').click(function() {
        
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          
  
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
    })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure ?',        
        text: "Reset STDPACK!",
       
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset Data',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
  }).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
                url: "{{url('stdpack/delete_all')}}",
                type: 'get',
                success: function(result) {
                  swalWithBootstrapButtons.fire(
                'SUCCESS!',
                'Your file has been reset.',
                'success'
                  )
                }

            });
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
  });
});

    // $('.delete-form').on('submit', function(e) {
    //   e.preventDefault();
    //   var button = $(this);

    //   Swal.fire({
    //     icon: 'warning',
    //       title: 'Are you sure you want to delete this record?',
    //       showDenyButton: false,
    //       showCancelButton: true,
    //       confirmButtonText: 'Yes'
    //   }).then((result) => {
    //     /* Read more about isConfirmed, isDenied below */
    //     if (result.isConfirmed) {
    //       $.ajax({
    //         type: 'get',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{url('stdpack/delete')}}",
    //         data: {
    //           '_method': 'delete'
    //         },
    //         success: function (response, textStatus, xhr) {
    //           Swal.fire({
    //             icon: 'success',
    //               title: response,
    //               showDenyButton: false,
    //               showCancelButton: false,
    //               confirmButtonText: 'Yes'
    //           }).then((result) => {
    //             window.location='/stdpack'
    //           });
    //         }
    //       });
    //     }
    //   });
      
    // })
  });
 
  
 



  $(function () {
    $.fn.dataTable.ext.errMode = 'throw';

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('stdpack') }}",
        columns: [
          {data: 'id', name: 'id'},
            {data: 'partnumber', name: 'partnumber'},
            {data: 'partname', name: 'partname'},
            {data: 'lenght', name: 'lenght'},
            {data: 'widht', name: 'widht'},
            {data: 'height', name: 'height'},
            {data: 'weight', name: 'weight'},
            {data: 'stdpack', name: 'stdpack'},
            {data: 'vendor', name: 'vendor'},
            {data: 'jknshelf', name: 'jknshelf'},

            
           
    //         // {
    //         //     data: 'action', 
    //         //     name: 'action', 
    //         //     orderable: true, 
    //         //     searchable: true
    //         // },
        ],
        // ,
        // button: [
        //   $.extend(true, {}, buttonCommon, {
        //             extend: 'copy',
        //             exportOptions: { columns: ':visible' }
        //         }),
        //         $.extend(true, {}, buttonCommon, {
        //             extend: 'csv',
        //             exportOptions: { columns: ':visible' }
        //         }),
        //         $.extend(true, {}, buttonCommon, {
        //             extend: 'print',
        //             exportOptions: { columns: ':visible' }
        //         }),  
        //     ]
    });
    
  });
</script>
@endsection