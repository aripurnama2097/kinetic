@extends('layouts.main')
 <head>
  
    
</head> 

@section('section')
{{-- <div class="page-wrapper"> --}}
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
         
        </div>
      </div>
    </div>



    <!-- Page body MENU -->
   {{-- <div class="page-body">
      
      <div class="container-xl mt-1 ">  --}}
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 " >
                <div class="card-body border-bottom ">
          
               
                  <h2 style="font-size:30px" class="text-dark text-center"> IN HOUSE MASTER </h2>
              
                 
                  <div class="btn-group mb-2">    
                  <button  id="delete-all-data" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> Reset Master</button>
                  <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modal-sa90"> <i class="ti ti-arrow-big-down-filled"></i>
                    Upload Master
                  </a>
                  <a href="{{url('/schedule_tentative/inhouse')}} " class="btn btn-success  btn-sm" >Refresh </a>
                </div>
                <a  href="{{url('/schedule_tentative')}}"class="btn btn-warning btn-sm float-right ">
                  <i class="ti ti-arrow-narrow-up"></i>
                  Go Top Menu
                </a>
     
             <div class="card mt-2">
              <div class="table-responsive  rounded-1 ">
                <table  id="sa-90" class="table table-bordered yajra-datatable">
                  <thead class="thead-dark">
                    <tr>                                         
                      <th style ="font-size: 10px;">Model</th>
                      <th style ="font-size: 10px;">Lot No</th>
                      <th style ="font-size: 10px;">Ship Qty</th>                                                
                      <th style ="font-size: 10px;">JKN PO</th>                       
                      <th style ="font-size: 10px;">Last Update</th>>                       
                    </tr>
                   </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>

                      <td style ="font-size: 12px;"> {{$item->model}} </td>
                      <td style ="font-size: 12px;"> {{$item->lotno}} </td>
                      <td style ="font-size: 12px;"> {{$item->shipqty}} </td>                
                      <td style ="font-size: 12px;"> {{$item->jknpo}}</td>     
                      <td style ="font-size: 12px;"> {{$item->created_at}}</td> 
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              
              </div>
             </div>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
{{-- ====================MODAL SA90 ========================================= --}}
<div class="modal modal-blur fade" id="modal-sa90" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lot Reference Upload</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
         
          <form  action="{{url('schedule_tentative/inhouse/upload')}}" enctype="multipart/form-data" method="POST" >
            @csrf
           
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Upload file</label>
                    <input  type="file" class="form-control" rows="3" name="file" required id="file">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-link link-warning" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <i class="ti ti-plus"></i>
                Upload 
              </button>
              
            </div>
          </form>
        </div>
  </div>
</div>



<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript">




            
$(document).ready(function () {

    // DATATABLE
    $('#sa-90').DataTable( {
        // dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );

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
        text: "Reset Inhouse Master!",
       
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset Data',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
  }).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
                url: "{{url('schedule_tentative/inhouse/delete')}}",
                type: 'get',
                success: function(result) {
                  swalWithBootstrapButtons.fire(
                'SUCCESS!',
                'Your file has been reset.',
                'success'
                  )
                }

            });
    ajax.reload();
    
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



   
  
 


    table = $('#datatable').DataTable( {
    paging: false
} );
 
      table.destroy();
      
      table = $('#datatable').DataTable( {
          searching: false
      } );





});


// $(function () {
//     $.fn.dataTable.ext.errMode = 'throw';
//     var table = $('.yajra-datatable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: "{{ url('/schedule_tentative/SA90') }}",
//         columns: [
         
//             {data: 'modelname', name: 'modelname'},
//             {data: 'prodNo', name: 'prodNo'},
//             {data: 'partnumber', name: 'partnumber'},
           
//             {data: 'qty', name: 'qty'}
           

       
           
           
//         ]
//     });
    
//   });



</script>




  @endsection