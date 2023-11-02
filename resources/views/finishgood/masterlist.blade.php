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
              Master List Data
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
           

                  <br>
                  @if(Session::has('success'))
                  <p class="alert alert-success">{{Session::get('success')}}</p>
                  @endif
  
              
            <div class="col-12">
              <div class="card  col-12 " >      
             
                <div class="card-body border-bottom ">                

                  <div class="table-responsive  rounded-1 shadow-sm">      
   
                   <table style="width:100%" id="download-master" class="table table-striped border border-primary shadow-sm" >
                     <thead class="thead-dark">
                       <tr>                   
                     
                        <th class="text-center" style ="font-size: 10px;">Start Carton</th>
                        <th  class="text-center"style ="font-size: 10px;">End Carton</th>
                        <th style ="font-size: 10px;">Packing No</th>
                        <th style ="font-size: 10px;">Skid No</th>
                        <th style ="font-size: 10px;">Custpo</th>        
                        <th style ="font-size: 10px;">Part No</th>           
                        <th style ="font-size: 10px;">Part Name</th>  
                        <th style="border-color:black"class="text-center" colspan="3">PACKING DETAIL</td>
                          <th style="border-color:black"class="text-center">TOTAL QTY</td>
                        <th style ="font-size: 10px;">GW</th>           
                        <th style ="font-size: 10px;">Height</th>
                        <th style ="font-size: 10px;">Type Skid</th>  
                       
                       
                              
                       </tr>
                      </thead>
         
                     <tbody>
                       @foreach($data as $key => $value)
                  
                       <tr>
                        <td class="text-center" style ="font-size: 12px;"> {{$value->start_carton}}</td>
                        <td  class="text-center"style ="font-size: 12px;">{{$value->end_carton}} </td>
                         <td style ="font-size: 12px;">{{$value->packing_no}} </td>
                         <td style ="font-size: 12px;">{{$value->skid_no}} </td>
                         <td style ="font-size: 12px;">{{$value->custpo}} </td> 
                         <td style ="font-size: 12px;">{{$value->partno}} </td> 
                         <td style ="font-size: 12px;">{{$value->partname}} </td>
                         <td style="border-color:black"class="text-center">{{$value->seq}} </td>
                         <td style="border-color:black"class="text-center">X</td>
                         <td style="border-color:black"class="text-center">{{$value->qty_running}}</td>
                         <td style="border-color:black"class="text-center">{{$value->total_running}}</td>
                    
                         <td style ="font-size: 12px;"> {{$value->gw}}</td> 
                         <td style ="font-size: 12px;"> {{$value->height}}</td> 
                         <td style ="font-size: 12px;"> {{$value->type_skid}}</td>        
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