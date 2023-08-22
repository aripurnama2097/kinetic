@extends('layouts.mainPartlist')
 <head>
  
    
</head> 

@section('section')
{{-- <div class="page-wrapper"> --}}
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <br>
          <div class="btn-group mt-3 mb-3">               
            <br>                  
           
   
          </div>
        
        </div>
      </div>
    </div>




    <!-- Page body MENU -->
    {{-- <div class="page-body"> --}}
      
        {{-- <div class="container-xl mt-1 "> --}}
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 " >
            
                <div class="card-body border-bottom ">
          
                 <div class="table-responsive  rounded-1">
                  @if(Session::has('success'))
                  <p class="alert alert-success">{{Session::get('success')}}</p>
                  @endif
                  @if(Session::has('oke'))
                  <p class="alert alert-success">{{Session::get('oke')}}</p>
                  @endif
                  @if(Session::has('delete'))
                  <p class="alert alert-info">{{Session::get('delete')}}</p>
                  @endif

                  <h2 style="font-size:30px" class="text-dark text-center"> SB98 TENTATIVE </h2>
                  <div class="btn-group mb-2">
                  <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-sb98"> <i class="ti ti-arrow-big-down-filled"></i>
                    Upload SB98
                  </a>
                  {{-- <button id="confirm-sb98" class="btn btn-secondary btn btn-sm" >
                    <i class="ti ti-merge"></i>
                    Summary SB98
                  </button> --}}
                  <button  id="delete-all-data" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> Reset Master</button>
                  <a href="{{url('/schedule_tentative/SB98')}} " class="btn btn-success  float-right" >Refresh </a>
                </div>
                  <br>
                  <br>
                  <br>
                  <div class="col-12">
                    <table  id="sb98-release" class="table table-bordered yajra-datatable" >
                      <thead class="thead-dark">
                        <tr>                   
                        
                          <th style ="font-size: 10px;">Customer Code</th>
                          <th style ="font-size: 10px;">Cust PO</th>
                          <th style ="font-size: 10px;">Part Number</th>
                          <th style ="font-size: 10px;">Part Name</th>                      
                          
                          <th style ="font-size: 10px;">Prod No</th>                       
                          <th style ="font-size: 10px;">Request Date</th>
                          <th style ="font-size: 10px;">JKEI Po Date</th>
                          <th style ="font-size: 10px;">Lot Qty</th>
                          <th style ="font-size: 10px;">Outset</th>
                          <th style ="font-size: 10px;">Van Date</th>
                          <th style ="font-size: 10px;">ETD</th>
                          <th style ="font-size: 10px;">ETA</th>
                          <th style ="font-size: 10px;">Upload by</th>
                          <th style ="font-size: 10px;">last Updated</th>
                         
                          
                        </tr>
                       </thead>
          
                      <tbody>

                        @foreach($data as $key => $value)
                       <tr>
                        <td style ="font-size: 12px;"> {{$value->cust_code}}</td>
                        <td style ="font-size: 12px;"> {{$value->cust_po}} </td>
                        <td style ="font-size: 12px;"> {{$value->partnumber}} </td>
                        <td style ="font-size: 12px;"> {{$value->partname}} </td>                
                        <td style ="font-size: 12px;"> {{$value->prodno}} </td>  
                        <td style ="font-size: 12px;"> {{$value->reqdate}}</td>  

                        <td style ="font-size: 12px;"> {{$value->jkeipodate}}</td>
                        <td style ="font-size: 12px;"> {{$value->qty}}</td>  

                        <td style ="font-size: 12px;"> {{$value->outset}}</td>
                        <td style ="font-size: 12px;"> {{$value->vandate}}</td>
                        <td style ="font-size: 12px;"> {{$value->etd}}</td>
                        <td style ="font-size: 12px;"> {{$value->eta}}</td>
                        <td style ="font-size: 12px;"> {{$value->input_user}}</td>
                        <td style ="font-size: 12px;"> {{$value->created_at}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <a href="{{url('/schedule_tentative')}} " class="btn btn-primary" >Back </a>
                  </div>

             
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      

   


{{-- ====================MODAL SB98 ========================================= --}}
<div class="modal modal-blur fade" id="modal-sb98" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sb98 Upload</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
         
          <form  action="{{url('/schedule_tentative/SB98/upload')}}" enctype="multipart/form-data" method="POST" >
            @csrf
           
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Input NIK</label>
                    <input  type="text" class="form-control mb-3" rows="3" name="uploadby"  id="uploadby" required>
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
                  <div class="spinner-border text-warning text-end mr-3" role="status">
                      <span class="sr-only">Loading...</span>
                  </div>
                </div>
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
    // $('#example').DataTable();
    $('#sb98-release').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );

    const cancelButton = document.querySelector('#cancel');
   const submitButton = document.querySelector('#submit');
  
    const spinner = document.querySelector('#spinner');
    // Ketika tombol submit diklik
    submitButton.addEventListener('click', function() {
      // Menampilkan spinner loading
      spinner.style.display = 'block';
    });




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
            url: "{{url('/schedule_tentative/SB98/sumsb98')}}",    
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

  
   



});


// $(function () {
//     $.fn.dataTable.ext.errMode = 'throw';
//     var table = $('.yajra-datatable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: "{{ url('/schedule_tentative/SB98') }}",
//         columns: [
         
//             {data: 'custcode', name: 'custcode'},
//             {data: 'custpo', name: 'custpo'},
//             {data: 'partnumber', name: 'partnumber'},
//             {data: 'partname', name: 'partname'},
           
//             {data: 'prodno', name: 'prodno'},
//             {data: 'reqdate', name: 'reqdate'},
//             {data: 'jkeipodate', name: 'jkeipodate'},
//             {data: 'qty', name: 'qty'},
//             {data: 'outset', name: 'outset'},
//             {data: 'vandate', name: 'vandate'},
//             {data: 'etd', name: 'etd'},
//             {data: 'eta', name: 'eta'}
           

       
           
           
//         ]
//     });
    
//   });





$('#delete-all-data').click(function() {
        
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          
  
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
    })

        swalWithBootstrapButtons.fire({
        title: 'Reset SB98 ?',        
        // text: "Reset SB98!",
       
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset Data',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
  }).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
                url: "{{url('schedule_tentative/SB98/delete')}}",
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
      ' file is safe :)',
      'error'
    )
  }
  });
});
</script>




  @endsection