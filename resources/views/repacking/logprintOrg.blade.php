@extends('layouts.main')
@section('section')

<style>
.bg-header{
  background-color: rgb(44, 138, 188);;
}

.bg-header1{
 color: #068c9b;;
}
</style>
{{-- #9ed9df --}}

<div class="page-wrapper">
    <!-- Page header -->
  


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
                  <h2 style="font-size:30px"class="text-primary bg-header1" >LOG PRINT LABEL KIT</h2> 
                  
                </div>
              
                <form class="mt-2 mb-2"action="{{url('repacking/logPrintOrg')}}" method="GET">			
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="card shadow-lg">
                          <div class="card-body bg-header">
                              <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">PROD NUMBER</h5>
                          </div>
                          <input type="text" name="prodno" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                      </div>
                  </div>

                    <div class="col-lg-3 ">
                      <div class="card shadow-lg">
                          <div class="card-body bg-header">
                              <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">CUSTPO</h5>
                          </div>
                          <input type="text" name="custpo" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                      </div>
                  </div>
      
                  <div class="col-lg-3">
                    <div class="card shadow-lg ">
                        <div class="card-body bg-header ">
                            <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">PART NUMBER</h5>
                        </div>
                        <input type="text"  name="partno" class="form-control form-control-sm" placeholder="please fill in"  autocomplete="off" autofocus>
                    </div>
                  </div>
    
                  <div class="col-lg-3">
                    <div class="card shadow-lg">
                        <div class="card-body bg-header">
                            <h5 style="font-weight:bold;font-size:18px" class="card-subtitle text-light  mb-0 text-center">ID NUMBER</h5>
                        </div>
                        <input type="text" name="idnumber" class="form-control form-control-sm" placeholder="please fill in" autocomplete="off" autofocus>
                    </div>
                </div>
              </div>  
              <div class="col-3 btn-group btn btn-sm mt-0 float-right">
                <button class="btn btn-info btn-sm " type="submit" ><i class="ti ti-search"></i> SEARCH</button> 
                <a class="btn btn-success btn-sm" href="{{ url('/repacking/logPrintOrg') }}"> Refresh <i
                  class="ti ti-refresh"></i> </a>
                  <button type="button" id="export-csv" data-toggle="tooltip" data-placement="left" title="" class="btn btn-secondary btn-sm" data-original-title="Download Report"><i class="ti ti-download"></i>export-csv</buton>
                  {{-- <button type="button" class="btn btn-primary mx-auto mx-md-0" onclick="printlabel()">Print label</button> --}}
              </div>
            </form>
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
                   <table id="log-data" style="width:100%" class="table table-striped border border-primary shadow-sm" >
                     <thead class="thead-dark">
                       <tr>      
                        {{-- <th scope="col"><input type="checkbox" id="check_all" /></th>          --}}
                        <th style ="font-size: 10px;">No</th>
                        <th style ="font-size: 10px;">ID Number</th>
                        <th style ="font-size: 10px;">Cust PO</th>
                        <th style ="font-size: 10px;">Part Number</th>
                        <th style ="font-size: 10px;">Part Name</th>   
                        <th style ="font-size: 10px;">Qty Issue</th>           
                        <th style ="font-size: 10px;">Cust Name</th> 
                        <th style ="font-size: 10px;">Shelf No</th>                       
                        <th style ="font-size: 10px;">Prod No</th>
                        <th style ="font-size: 10px;">Lot Inhouse</th>
                        <th style ="font-size: 10px;">Create Date</th>
                         <th style ="font-size: 10px;">Last Print</th>  
                         <th style ="font-size: 10px;">Print</th>                             
                       </tr>
                      </thead>
         
                     <tbody>
                       @foreach($data_log as $key => $value)
                       {{-- {{$no = ++$i}}; --}}
                        <tr>
                          {{-- <td><input type="checkbox" id="nomor{{$no}}" name="nomor{{$no}}" value="{{$value->idnumber}}" />
                            <input type="hidden" id="custpo{{$no}}" name="custpo{{$no}}" value="{{$value->custpo}}" />
                            <input type="hidden" id="partno{{$no}}" name="partno{{$no}}" value="{{$value->partno}}"/>             
                        </td>                         --}}
                        <td class="text-center">{{ ++$i}}</td>
                         <td style ="font-size: 12px;"> {{$value->idnumber}}</td>
                         <td style ="font-size: 12px;">{{$value->custpo}} </td>
                         <td style ="font-size: 12px;">{{$value->partno}} </td>
                         <td style ="font-size: 12px;">{{$value->partname}} </td> 
                         <td style ="font-size: 12px;"> {{$value->qty_scan}}</td>  
                         <td style ="font-size: 12px;"> {{$value->dest}}</td>                    
                         <td style ="font-size: 12px;"> {{$value->shelfno}}</td>       
                         <td style ="font-size: 12px;"> {{$value->prodno}}</td> 
                         <td style ="font-size: 12px;"> {{$value->lotno_inhouse}}</td> 
                         <td style ="font-size: 12px;"> {{$value->created_at}}</td>               
                         </td>    
                         <td style ="font-size: 12px;"> {{$value->last_print}} </td>               
                         </td>   
                         <td style ="font-size: 12px;">
                          <a  class="btn btn-primary btn-sm text-white"  data-toggle="modal" data-target="#logPrintOrg_{{$value->id}}">Print KIT</a>
                          <div class="modal modal-blur fade" id="logPrintOrg_{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Print Label KIT</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                               
                                    <div class="modal-body">
                                
                                      <form action="{{ url('repacking/logPrintOrg/' . $value->id) }}" method="POST" >
                                      
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">PIC</label>
                                            <input type="text" name="pic_print"  id="pic_print" class="form-control" name="example-text-input"  placeholder="PIC">
                                        </div>                                       
                                    </div>  
                        
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-light link-warning" data-bs-dismiss="modal">
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



                        </td>       
                   
                        
                           
                       </tr>
                       @endforeach
                     </tbody>
               
                   </table>
                  
                  </div>
                  <div class="d-flex justify-content-center col-12 btn-sm">
                    {{ $data_log->links('vendor.pagination.custom') }}
  
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
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });  
$(document).ready( function () { 

  //               } );
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



    $("#export-csv").on("click",function(){
      window.open("{{url('/repacking/logPrintOrg/download')}}");    
    });

  });


  // function printlabel(){
  //   var array = [];
  //   $("input:checked").each(function() {
  //       array.push($(this).val());
  //   });

  //   var array = [];
  //   var arrayid = [];
  //   $("input:checked").each(function() {
  //       array.push($(this).val());
  //       arrayid.push($(this).attr('id').replace("nomor", ""));
  //   });

  //   var idnumber = array[0];
  //   var nomor = arrayid[0];

  //   console.log(idnumber,nomor)


  // }

</script>
@endsection