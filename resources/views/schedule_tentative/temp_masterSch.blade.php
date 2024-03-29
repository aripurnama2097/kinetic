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
                  <h2 style="font-size:30px" class="text-dark text-center mb-3"> SERVICE PART</h2>  
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
                  <a href="{{url('/schedule_tentative/master_scheduleTemp')}} " class="btn btn-success btn-sm" >Refresh </a>
                  <button data-bs-toggle="modal" data-bs-target="#check" class="btn btn-dark btn-sm  ">
                    <i class="ti ti-check"></i>
                    Check Data Stdpack
                </button>

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
                            {{-- <th style ="font-size: 10px;">No</th> --}}
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
                        {{-- <td style ="font-size: 12px;"> {{$value->id}}</td> --}}
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
                    <table  id="result" class="table table-bordered" >
                      <thead class="border">
                        <tr>    
                            <th style ="font-size: 10px;">Remark</th>                       
                            <th style ="font-size: 10px;">Customer Code</th>
                            <th style ="font-size: 10px;">Cust PO</th>
                            <th style ="font-size: 10px;">Part Number</th>
                            <th style ="font-size: 10px;">Part Name</th>                      
                            <th style ="font-size: 10px;">Prod No</th> 
                            <th style ="font-size: 10px;">Demand</th>                      
                            
                        </tr>
                       </thead>        
                      <tbody>
                        @foreach($result as $key => $value)
                        <tr>
                          <td style ="font-size: 12px;"> <?php 
                          
                          if($value->custpo == $value->cust_po && $value->partnumber == $value->partno  && $value->demand == $value->qty){
                   
                          echo '<span class= "badge text-bg-success">OK</span>';
                          }
                          
                            
                           else if($value->custcode ==null){
                              echo '<span class= "badge text-bg-danger">Error! Cust Code '.$value->custcode.' Tidak Ditemukan</span>';
                            }
                            elseif($value->custpo != $value->cust_po){

                              $msg_custpo = $value->custpo;
                              $msg_cust_po = $value->cust_po;

                              if($msg_custpo == ''){
                                $msg_custpo = 'Tidak Ada';
                              }
                              if($msg_cust_po == ''){
                                $msg_cust_po = 'Tidak Ada';
                              }

                              echo '<span class= "badge text-bg-danger">Error!Custpo '.$msg_custpo.', seharusnya  '.$msg_cust_po.'</span>';
                            }
                            
                            elseif($value->partnumber != $value->partno){
                              $msg_partnumber = $value->partnumber;
                              $msg_partno = $value->partno;

                              if($msg_partnumber == ''){
                                $msg_partnumber = 'Tidak Ada';
                              }
                              if($msg_partno == ''){
                                $msg_partno = 'Tidak Ada';
                              }

                              echo ' <span class= "badge text-bg-danger">Error!partnumber '.$msg_partno.', seharusnya  '.$msg_partnumber.'</span>';
                            }

                            elseif($value->demand != $value->qty){
                              $msg_demand = $value->demand;
                              $msg_qty = $value->qty;

                              if($msg_demand == ''){
                                $msg_demand = 'Tidak Ada';
                              }
                              if($msg_qty == ''){
                                $msg_qty = 'Tidak Ada';
                              }

                              echo ' <span class= "badge text-bg-danger">Error! Qty '.$msg_demand.', seharusnya  '.$msg_qty.'</span>';
                            }
                            ?>
                            </td>
                         <td style ="font-size: 12px;"> {{$value->custcode}}</td>
                         <td style ="font-size: 12px;"> {{$value->custpo}} </td>
                         <td style ="font-size: 12px;"> {{$value->partno}} </td>
                         <td style ="font-size: 12px;"> {{$value->partname}} </td>                
                         <td style ="font-size: 12px;"> {{$value->prodno}} </td>   
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
          <form  action="{{url('/schedule_tentative/master_scheduleTemp/importsch')}}" enctype="multipart/form-data" method="POST" >
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


 {{-- ====================GENERATE PARTLIST========================================= --}}
 <div class="modal modal-blur fade" id="check" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">CHECK DATA STDPACK</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ url('schedule_tentative/check_data') }}" method="GET">
              @csrf
              <div class="modal-body">
                  <div class="row">
                      <div class="col-lg-12">
                          <div>
                            
                              <input class="form-control" name="prodno" id="prodno" placeholder="INPUT PRODNO"
                              required>
                               <br>
                             

                              <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                                  <i class="ti ti-file-export"></i>
                                  Submit
                              </button>
                              <br>
                              <br>
                              <p style="font-wight:bold" class="text-danger"> * Pastikan Prod No yang di input sudah
                                  sesuai </p>
                          </div>
                      </div>
                  </div>
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

    // cancelButton.addEventListener('click', function() {
    //   // Menampilkan spinner loading
    // spinner.style.display = 'none';
    // });



    // $('#submit').click(function() {
    // const Toast = Swal.mixin({
    //   toast: true,
    //   position: 'top-end',
    //   showConfirmButton: false,
    //   timer: 5000,
    //   timerProgressBar: true,
    //   didOpen: (toast) => {
    //     toast.addEventListener('mouseenter', Swal.stopTimer)
    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
    //   }
    // })
    
    // Toast.fire({
    //   icon: 'info',
    //   title: 'Process Compare'
    // })
    
    // });
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
                        url: "{{url('schedule_tentative/schTemp/delete')}}",
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