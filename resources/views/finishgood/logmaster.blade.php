@extends('layouts.main')
@section('section')


<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col-12 ">
            <!-- Page pre-title -->
            <div class="page-pretitle">
              Overview
            </div>
            <h2 class="page-title">
              Log Print Master
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">             
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Page body MENU -->
    <div class="page-body">
      <div class="container-xl">
        {{-- <div class="row row-deck row-cards">
        
        </div> --}}
      </div>
    
        {{-- <div class="container-xl mt-1 ">
          <div class="row row-deck row-cards ">           --}}
            <div class="col-12 ">
              <div class="card rounded-1 col-12 " >
                <div class="card-header text-center justify-content-center">
                  <h2 style="font-size:30px"class="text-dark " >--LOG PRINT MASTER-</h2> 
                </div>
            

              </div>
            </div>

                  <br>
                  @if(Session::has('success'))
                  <p class="alert alert-success">{{Session::get('success')}}</p>
                  @endif
  
              
            <div class="col-12">
              <div class="card  col-12 " >      
             
                <div class="card-body border-bottom ">                

                  <div class="table-responsive  rounded-1 shadow-sm">      
                              
                    <a  href="{{url('/finishgood/viewSkid')}}"class="btn btn-warning btn-sm float-right ">
                      <i class="ti ti-arrow-narrow-up"></i>
                      Go Top Menu
                    </a>
                   <table style="width:100%" id="download-master" class="table table-striped border border-primary shadow-sm" >
                     <thead class="thead-dark">
                       <tr>                       
                        <th class="text-center" style ="font-size: 10px;">Start Carton</th>
                        <th  class="text-center"style ="font-size: 10px;">End Carton</th>
                        <th class="text-center" style ="font-size: 10px;">Combine No</th>
                        <th  class="text-center"style ="font-size: 10px;">Packing No</th>
                        <th  class="text-center"style ="font-size: 10px;">Skid No</th>
                        <th  class="text-center"style ="font-size: 10px;">Part No</th>           
                        <th  class="text-center"style ="font-size: 10px;">Part Name</th>    
                        <th class="text-center" style="border-color:black"class="text-center" colspan="3">PACKING DETAIL</td>
                          <th  class="text-center"style="border-color:black"class="text-center">TOTAL QTY</td>                    
                        <th style ="font-size: 10px;">Print</th>         
                       </tr>
                      </thead>        
                     <tbody>
                       @foreach($data as $key => $value)
                  
                       <tr>
                        <td class="text-center" style ="font-size: 12px;"> {{$value->start_carton}}</td>
                        <td  class="text-center"style ="font-size: 12px;">{{$value->end_carton}} </td>
                         <td  class="text-center"style ="font-size: 12px;"> {{$value->carton_no}}</td>
                         <td  class="text-center"style ="font-size: 12px;">{{$value->packing_no}} </td>
                         <td  class="text-center"style ="font-size: 12px;">{{$value->skid_no}} </td>
                         <td  class="text-center"style ="font-size: 12px;">{{$value->partno}} </td> 
                         <td  class="text-center"style ="font-size: 12px;">{{$value->partname}} </td>
                         <td  class="text-center"style="border-color:black"class="text-center">{{$value->seq}} </td>
                         <td  class="text-center"style="border-color:black"class="text-center">X</td>
                         <td  class="text-center"style="border-color:black"class="text-center">{{$value->qty_running}}</td>
                         <td  class="text-center"style="border-color:black"class="text-center">{{$value->total_running}}</td>
                         <td style ="font-size: 12px;">

                        
                          <a  class="btn btn-primary btn-sm text-white "  data-toggle="modal" data-target="#logPrintOrg_{{$value->id}}"><i class="ti ti-printer"></i>Re Print</a>
                          <a  class="btn btn-warning btn-sm text-white "  data-toggle="modal" data-target="#change_{{$value->id}}"><i class="ti ti-edit"></i>Change</a>
                        
                          <div class="modal modal-blur fade" id="logPrintOrg_{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Print Master</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> 
                                    <div class="modal-body">                               
                                      <form action="{{ url('/finishgood/viewSkid/logprintMaster/' . $value->id) }}" method="POST" >
                                      
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">PIC</label>
                                            <input type="text" name="pic_print"  id="pic_print" class="form-control mb-2" name="example-text-input"  placeholder="PIC">
                                            {{-- <label class="form-label">START CARTON</label>
                                            <input type="text" name="start_carton"  id="start_carton" class="form-control mb-2" name="example-text-input"  placeholder="PIC">
                                            <label class="form-label">END CARTON</label>
                                            <input type="text" name="end_carton"  id="end_carton" class="form-control mb-2" name="example-text-input"  placeholder="PIC"> --}}
                                        </div>                                       
                                    </div>  
                        
                                    <div class="modal-footer">
                                      <button type="button shadow-lg" class="btn btn-light link-warning" data-bs-dismiss="modal">
                                        Cancel
                                      </button>
                                      <button  type="submit"  class="btn btn-primary ms-auto" >
                                        Print
                                      </button>
                                  </div>
                                </form>
                            </div> 
                              </div>
                            </div>
                          </div>



                          <div class="modal modal-blur fade" id="change_{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Change Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> 
                                    <div class="modal-body">                               
                                      <form action="{{ url('/finishgood/viewSkid/changemaster/' . $value->id) }}" method="POST" >
                                      
                                        @csrf
                                        <div class="mb-3">
                                            
                                            <label class="form-label">START CARTON</label>
                                            <input type="text" name="start_carton"  id="start_carton" class="form-control mb-2" name="example-text-input"  placeholder="START CARTON">
                                            <label class="form-label">END CARTON</label>
                                            <input type="text" name="end_carton"  id="end_carton" class="form-control mb-2" name="example-text-input"  placeholder="END CARTON">
                                        </div>                                       
                                    </div>  
                        
                                    <div class="modal-footer">
                                      <button type="button shadow-lg" class="btn btn-light link-warning" data-bs-dismiss="modal">
                                        Cancel
                                      </button>
                                      <button  type="submit"  class="btn btn-primary ms-auto" >
                                       Save
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
          </div>
        </div>    
    </div>
</div>

<script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>

<script type="text/javascript"> 
$(document).ready( function () { 
  $('#download-master').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );

$('#print_kitOrg').on('submit', function(e) {
       e.preventDefault(); 

      var scan_nik         = $('#scan_nik').val();


      $.ajax({
            type    :"POST",
            dataType:"json",
            data    :{scan_nik:scan_nik},
            url     :"{{url('repacking/printOriginal/{id}/')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function(response){
                // window.location.replace(response.redirect);
                console.log(response);
                // return;
              


                // let custpo       = response.param.custpo;
                // let dest   = response.param.dest;
                // let partno  = response.param.partno;
                // let partname          = response.param.partname;
                // let mcshelfno          = response.param.mcshelfno;
                // let prodno          = response.param.prodno;
        
                // window.open("../../printLabel.php"+"?label_balance="+label_balance+"&label_sorting="+label_sorting+"&lokasi="+lokasi
                // +"&part_number="+part_number+"&po="+po+"&supplierName="+supplierName+"&type="+type+"&qty_actual"+qty_actual); 
              
              
              
            },

        

            failure: function(form, action) {
                    Ext.Msg.show({
                        title: 'OOPS, AN ERROR JUST HAPPEN !',
                        icons: Ext.Msg.ERROR,
                        msg: action.result.msg,
                        buttons: Ext.Msg.OK
                    });
                }
            }) 


    });


  });

</script>
@endsection