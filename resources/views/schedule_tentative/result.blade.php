@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl ml-2">
              Overview
              <h2 class="page-title text-light"> Tentative Schedule </h2>
          </div>
        </div>

        <!-- Page body MENU -->
      
        <div class="page-body">
          <div class="row row-deck row-cards ">          
            <div class="col-12 ">
              <div class="card rounded-1 " >
                <div class="col-12 border-bottom bt-2  ">
                </div>

                <div class="card-body border-bottom ">
                  
                 <div class="table-responsive  rounded-1">
                  @if(Session::has('success'))
                  <p class="alert alert-success bg-success text-light">{{Session::get('success')}}</p>
                  @endif

                  @if(Session::has('error'))
                  <p class="alert alert-danger bg-danger text-light">{{Session::get('error')}}</p>
                  @endif
                 <div class="row-2 ml-4 mb-2 ">
                  <a data-bs-toggle="modal" data-bs-target="#modal-sch"
                    class="btn btn-primary  text-light ">
                    <i class="ti ti-file-export"></i>
                    Generate Schedule
                  </a>       
                    <button  id="generate-inhouse" class="btn btn-dark d-none d-sm-inline-block">
                      <i class="ti ti-file-export"></i>
                      Generate Inhouse
                    </button>
                    <a href="{{url('/schedule_tentative/result')}} " class="btn btn-success " ><i class="ti ti-360"></i>Refresh 
                    </a>
                  </button>
                  </div>

                  <div class="col-12">
                    <table style="width:100%" id="sch-tentative" class="text-nowrap  table table-striped border border-secondary table-sm" >
                      <thead class="thead-dark">
                        <tr>                   
                          <th style ="font-size: 10px;">Result</th>  
                          {{-- <th style ="font-size: 10px;">Schedule Code</th>  --}}
                          <th style ="font-size: 10px;">Customer Code</th>
                          <th style ="font-size: 10px;">Destination</th>
                          <th style ="font-size: 10px;">Attention</th>
                          <th style ="font-size: 10px;">Model</th>
                      
                          <th style ="font-size: 10px;">Prod No</th>
                        
                          <th style ="font-size: 10px;">Lot Qty</th>
                          <th style ="font-size: 10px;">JKEI Po Date</th>
                          <th style ="font-size: 10px;">Van Date</th>
                          <th style ="font-size: 10px;">ETD</th>
                          <th style ="font-size: 10px;">ETA</th>
                          <th style ="font-size: 10px;">Ship Via</th>
                          <th style ="font-size: 10px;">Order Item</th>
                          <th style ="font-size: 10px;">Cust PO</th>
                          <th style ="font-size: 10px;">Part Number</th>
                          <th style ="font-size: 10px;">Part Name</th>                      
                          <th>Demand</th>                             
                          
                        </tr>
                       </thead>
          
                      <tbody>
                        @foreach($data as $key => $value)
                        <tr class="border border-dark">

                         <td style ="font-size: 12px;"> <?php 
                         if($value->partnumber == NULL){
                           echo '<span class= "badge text-bg-danger"> Part Number Tidak Sesuai</span>';
                         }
                        
                         
                         if($value->custcode == NULL){
                           echo '<span class= "badge text-bg-danger"> Cust Code Tidak Ditemukan</span>';
                         }

                         if($value->partnumber != NULL){
                           echo '<span class= "badge text-bg-success"> OK</span>';
                         }
                         
                         ?>
                         </td>
                          {{-- <td style ="font-size: 12px;"> tes</td> --}}
                          <td style ="font-size: 12px;"> {{$value->custcode}}</td>
                          <td style ="font-size: 12px;"> {{$value->dest}}</td>
                          <td style ="font-size: 12px;"> {{$value->attention}}</td>
                          <td style ="font-size: 12px;"> {{$value->model}}</td>
                       
                          
                          <td style ="font-size: 12px;"  data-order="1" data-filter="prodno"> {{$value->prodno}}</td>
                          <td style ="font-size: 12px;"> {{$value->lotqty}}</td>
                          <td style ="font-size: 12px;"> {{$value->jkeipodate}}</td>
                          <td style ="font-size: 12px;"> {{$value->vandate}}</td>
                          <td style ="font-size: 12px;"> {{$value->etd}}</td>
                          <td style ="font-size: 12px;"> {{$value->eta}}</td>
                          <td style ="font-size: 12px;"> {{$value->shipvia}}</td>
                          <td style ="font-size: 12px;"> {{$value->orderitem}}</td>
                          <td style ="font-size: 12px;"> {{$value->custpo}} </td>
                          <td style ="font-size: 12px;"> {{$value->partno}} </td>
                          <td style ="font-size: 12px;"> {{$value->partname}} </td>                
                          <td style ="font-size: 12px;"> {{$value->demand}}</td>      
                         
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
            </div>
        </div>
    </div>


             

    {{-- ====================GENERATE PARTLIST========================================= --}}
    <div class="modal modal-blur fade" id="modal-sch" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">SCHEDULE GENERATE</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ url('schedule_tentative/result/generate') }}" method="POST">
                  @csrf
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <div>
                                  <label class="form-label required">PIC </label>
                                  <input class="form-control" name="nik" id="nik" placeholder="PIC"
                                      required>
                                  <br>
                                  <select style="font-size:15px" class="form-control col-8 btn btn-light btn-sm"
                                      id="prodno" name="prodno">

                                      @foreach ($dataprodno as $dd)
                                          <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                                      @endforeach
                                  </select>


                                  <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                                      <i class="ti ti-file-export"></i>
                                      Release
                                  </button>
                                  <br>
                                  <br>
                                  <p style="font-wight:bold" class="text-danger"> * Pastikan Prod No yang dipilih sudah
                                      sesuai </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">

        $(document).ready(function() {
           $('#sch-tentative').DataTable( {
                dom: 'Bfrtip',
                // dom: '<"top"i>rt<"topflp><"clear">',
                buttons: [
                  
                    'excelHtml5',
                    'csvHtml5'
                ]
    } );



    //GENERATE SCHEDULE 
    $('#generate-inhouse').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
          html:
          '<input id="nik" name="nik" class=" col-8" type="text" placeholder="INPUT NIK" maxlenght="5">',
          icon: 'warning',
          title: ' Generate Inhouse?',
          // input :text,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
        
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          nik= $('#nik').val();
          $.ajax({
            type: 'post',
            data:{
                    nik:nik

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('schedule_tentative/result/generateinhouse')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Generate Schedule',
                  'success'
                    )
              }
          });
        }
      });
    });


        });
    </script>
@endsection
