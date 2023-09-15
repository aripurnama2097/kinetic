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
        <div class="card">
          <div class="row row-deck row-card ">          
            <div class="col-12 bg-dark ">
              <div class="card rounded-1 " >
                <div class="card-body border-bottom  ">            
                  <h2 style="font-size:30px" class="text-dark text-center mb-3"> SKD PART</h2>  
                  @if(Session::has('success'))
                  <p class="alert alert-success bg-success text-light">{{Session::get('success')}}</p>
                  @endif

                  @if(Session::has('error'))
                  <p class="alert alert-danger bg-danger text-light">{{Session::get('error')}}</p>
                  @endif
                   @if(Session::has('delete'))
                   <p class="alert alert-info">{{Session::get('delete')}}</p>
                   @endif               
                  <div class="btn-group btn-sm mb-2 mt-3">
                    
                  
                  <button  id="delete-all-data" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> Reset Master</button>
                  <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modal-schtemp"> <i class="ti ti-file-upload"></i></i>
                    Upload Master
                  </a>
                  <a href="{{url('schedule_tentative/headersch')}}" class="btn btn-primary btn-sm"> <i class="ti ti-arrow-big-down-filled"></i>
                    Header
                  </a>
                
                 

                </div>
                <a  href="{{url('/schedule_tentative')}}"class="btn btn-warning btn-sm float-right ">
                  <i class="ti ti-arrow-narrow-up"></i>
                  Go Top Menu
                </a>
                   <br>
                 <div class="card ">
                  <div class="table-responsive  rounded-1 mt-2  ">
                    <table  id="sch-temp" class="table table-bordered yajra-datatable" >
                      <thead class="thead-dark">
                        <tr>                                           
                            <th style ="font-size: 10px;">Customer Code</th>
                            <th style ="font-size: 10px;">Cust PO</th>
                            <th style ="font-size: 10px;">Part Number</th>
                            <th style ="font-size: 10px;">Part Name</th>                                               
                            <th style ="font-size: 10px;">Prod No</th>                                           
                            <th style ="font-size: 10px;">JKEI Po Date</th>            
                            <th style ="font-size: 10px;">Van Date</th>
                            <th style ="font-size: 10px;">ETD</th>
                            <th style ="font-size: 10px;">ETA</th> 
                            <th style ="font-size: 10px;">Demand</th>
                            <th style ="font-size: 10px;">Upload by</th>
                            <th style ="font-size: 10px;">last Updated</th>
                         
                         
                          
                        </tr>
                       </thead>
          
                      <tbody>
                        @foreach($data as $key => $value)
                        <tr>
                         <td style ="font-size: 12px;"> {{$value->custcode}}</td>
                         <td style ="font-size: 12px;"> {{$value->custpo}} </td>
                         <td style ="font-size: 12px;"> {{$value->partno}} </td>
                         <td style ="font-size: 12px;"> {{$value->partname}} </td>                
                         <td style ="font-size: 12px;"> {{$value->prodno}} </td>           
                         <td style ="font-size: 12px;"> {{$value->jkeipodate}}</td>
                         <td style ="font-size: 12px;"> {{$value->vandate}}</td>
                         <td style ="font-size: 12px;"> {{$value->etd}}</td>
                         <td style ="font-size: 12px;"> {{$value->eta}}</td>
                         <td style ="font-size: 12px;"> {{$value->demand}}</td>
                         <td style ="font-size: 12px;"> {{$value->input_user}}</td>
                         <td style ="font-size: 12px;"> {{$value->updated_at}}</td>
                           </tr>
                         @endforeach
                      </tbody>
                    </table>
                   
                  </div>
                  </div> 
                {{-- MASTER --}}
                 

                   {{-- RESULT --}}
                 
                   <div class="card ">
                    <h2 class="mt-2 ml-2">DATA HASIL COMPARE</h2>
                   <div class="table-responsive  rounded-1 mt-2">
                    <table class="table table-bordered" >
                      <thead class="border">
                        <tr>    
                            <th style ="font-size: 10px;">Remark</th>                       
                            <th style ="font-size: 10px;">Model</th>
                            <th style ="font-size: 10px;">Prodno</th>
                            <th style ="font-size: 10px;">Part Number</th>
                            <th style ="font-size: 10px;">Part Name</th>                      
                     
                            <th style ="font-size: 10px;">Demand</th>                      
                            
                        </tr>
                       </thead>  
                       <tbody>
                        @foreach($result as $key => $value)
                        <tr>
                          <td style ="font-size: 12px;"> <?php
                          
                          if( $value->partnumber != null   ){  
                                   
                              echo '<span class= "badge text-bg-success">OK</span>';
                          }

                          else if($value->partnumber ==null){
                              echo '<span class= "badge text-bg-danger">Error! partnumber '.$value->partnumber.' Tidak Ditemukan</span>';
                          }
                          ?>
                          </td>
                          <td style ="font-size: 12px;"> 
                          {{$value->model}}</td>
                          <td style ="font-size: 12px;"> {{$value->prodno}} </td>
                          <td style ="font-size: 12px;"> {{$value->partno}} </td>
                          <td style ="font-size: 12px;"> {{$value->partname}} </td>                
                        
                          <td style ="font-size: 12px;"> {{$value->demand}} </td>
                        </tr>
                        @endforeach
                       </tbody>      
                     
                    </table>
                    <br>
         
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
        </div>
      </div>
    </div>
      

    
{{-- ====================MODAL Schedule Temp ========================================= --}}
<div class="modal modal-blur fade" id="modal-schtemp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Schedule Temp</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form  action="{{url('/schedule_tentative/skdpart/importskd')}}" enctype="multipart/form-data" method="POST" >
            @csrf  
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Input NIK</label>
                    <input  type="text" class="form-control mb-2" rows="3" name="uploadby"  id="uploadby" required>
                    <label class="form-label">Upload file</label>
                    <input  type="file" class="form-control" rows="3" name="file"  id="file" required>
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
                  <div style="fopnt-weight:bold" class="spinner-border text-warning text-end mr-3" role="status">
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
    $('#sch-temp').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );


    $('#result').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );



  // RESET MASTER
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
        text: "Reset Master Schedule!", 
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset Data',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
     }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                        url: "{{url('schedule_tentative/skdpart/delete')}}",
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








});





</script>
  @endsection