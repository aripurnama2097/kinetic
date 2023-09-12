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
          
               
                  <h2 style="font-size:30px" class="text-dark text-center"> SA 90 DATA </h2>
                  @if(Session::has('success'))
                  <p class="alert alert-success bg-success text-light">{{Session::get('success')}}</p>
                  @endif

                  @if(Session::has('error'))
                  <p class="alert alert-danger bg-danger text-light">{{Session::get('error')}}</p>
                  @endif
                 
                  <div class="btn-group mb-2">
              
                  <button  id="delete-all-data" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> Reset Master</button>
                  <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-sa90"> <i class="ti ti-arrow-big-down-filled"></i>
                    Upload SA90
                  </a>
                  <a href="{{url('/schedule_tentative/SA90')}} " class="btn btn-success  float-right" >Refresh </a>
                </div>
                <br>
             
                  <div class="table-responsive  rounded-1 mb-5">
                    <table  id="sa-90" class="table table-bordered " >
                      <thead class="thead-dark">
                        <tr>                                         
                          <th style ="font-size: 10px;">Model</th>
                          <th style ="font-size: 10px;">Prod No</th>
                          <th style ="font-size: 10px;">Part Number</th>                                                
                          <th style ="font-size: 10px;">Demand</th>                       
                          <th style ="font-size: 10px;">Last Update</th>                       
                        </tr>
                       </thead>
                      <tbody>
                        @foreach ($data as $item)
                        <tr>

                          <td style ="font-size: 12px;"> {{$item->modelname}} </td>
                          <td style ="font-size: 12px;"> {{$item->prodNo}} </td>
                          <td style ="font-size: 12px;"> {{$item->partnumber}} </td>                
                          <td style ="font-size: 12px;"> {{$item->qty}}</td>     
                          <td style ="font-size: 12px;"> {{$item->updated_at}}</td> 
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                    <br>       
                    <a href="{{url('/schedule_tentative')}} " class="btn btn-primary" >Back </a>      
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
            <h5 class="modal-title">SA90 Upload</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
         
          <form  action="{{url('schedule_tentative/SA90/upload')}}" enctype="multipart/form-data" method="POST" >
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
              <button id="submit" type="submit"  class="btn btn-primary ms-auto" >
                <div id="spinner" class="spinner" style="display: none;">
                  <div style="fopnt-weight:bold" class="spinner-border text-success text-end mr-3" role="status">
                      <span class="sr-only">Loading...</span>
                  </div>
                  {{-- <span class="spinner-border spinner-border-sm"></span>
                  Loading.. --}}
                </div>

                {{-- <div class="spinner-grow text-warning"></div> --}}
                {{-- <div id="btn-upload" class="btn btn-primary ms-auto" style="display: none;"> --}}
                UPLOAD
                {{-- </div> --}}
              </button>
              
            </div>
          </form>
        </div>
  </div>
</div>



<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript">




            
$(document).ready(function () {
   const cancelButton = document.querySelector('#cancel');
   const submitButton = document.querySelector('#submit');
   const submitButton2 = document.querySelector('#btm-upload');
  
  
    const spinner = document.querySelector('#spinner');
    // Ketika tombol submit diklik
    submitButton.addEventListener('click', function() {
      // Menampilkan spinner loading
      spinner.style.display = 'block';
      submitButton2.style.display = 'none';
      
    });


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
        text: "Reset SA90!",
       
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset Data',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
  }).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
                url: "{{url('schedule_tentative/SA90/delete')}}",
                type: 'get',
                success: function(result) {
                  swalWithBootstrapButtons.fire(
                'SUCCESS!',
                'Your file has been reset.',
                'success'
                  )
                  window.location.reload();
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



    // $('#example').DataTable();
    
    // CONFIRM SUMMARY SB98
    $('#confirm-sb98').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure summary SB98?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('/schedule/sumsb98')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Summary Finish.',
                  'success'
                    )
              }
          });
        }
      });
    });

  
    //GENERATE SCHEDULE 
    $('#generate-sch').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure Generate schedule?',
          // input :text,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
        
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('schedule_tentative/generate')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Update Schedule',
                  'success'
                    )
              }
          });
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