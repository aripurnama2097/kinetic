@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl ml-2">
              Overview
              <h2 class="page-title text-light"> Release Schedule </h2>
          </div>
        </div>

        <!-- Page body MENU -->
        <div class="bg-dark mt-3">
            <div class="container-fluid">
              <div class="card ml-3 mr-3">
               
                  <div class="card-body">                
                  <div class="col-12 btn-group">                  
                    <a class="btn btn-dark text-white " data-bs-toggle="collapse" id="btn-sch"  role="button"
                        aria-expanded="false" aria-controls="partlist">
                        <i class="ti ti-calendar"></i>
                        SHOW DATA
                   </a>

                    <a class="btn btn-primary text-white " data-bs-toggle="collapse" id="btn-dic"  role="button"
                        aria-expanded="false" aria-controls="partlist">
                        <i class="ti ti-mail"></i>
                        ADD DIC
                    </a>   

                  </div>               
                </div>
            </div>
            </div>
            <div class="container-fluid mt-1">

                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif


                    <div class="col-12 "> 
                            {{-- SHOW DATA SCHEDULE --}}
                        <div class="collapse mt-4" id="view-schedule" hide>
                          <div class="card  col-12 ">
                          <h4 style="font-size:25px"class="card-title text-primary mt-3 ml-3">  <i class="ti ti-calendar"></i>SCHEDULE RELEASE</h4>
                            <div class="btn-group mt-3 ml-4 col-6">
                                <button data-bs-toggle="modal" data-bs-target="#check" class="btn btn-dark btn-sm  ">
                                    <i class="ti ti-check"></i>
                                    Check Data 
                                </button>

                                <button id="share-schedule" class="btn btn-info btn-sm  ">
                                    <i class="ti ti-share"></i>
                                    Share Schedule
                                </button>
            
                                <a data-bs-toggle="modal" data-bs-target="#modal-partlist"
                                    class="btn btn-success  btn-sm text-light ">
                                    <i class="ti ti-file-export"></i>
                                    Generate Partlist
                                </a>
                             
                                <a data-bs-toggle="modal" data-bs-target="#cancel-partlist"
                                   class="btn btn-danger btn-sm   text-light "><i class="ti ti-circle-letter-x"></i>
                                    Cancel Partlist
                                </a>
                            </div>
                           
        
                            <div class="card-body border-bottom ">                           
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    {{-- <p class="btn btn-primary btn-sm"style="font-weight:bold;font-size:15px"> Schedule Number: </p>      --}}
                                    <table style="width:100%" id="schedule-release"  class="table  table-bordered border-dark shadow-sm">                                   
                                        <thead class="thead-dark">
                                            <tr class="headings">
                                                <th style="font-size: 10px;">Schedule Number</th>
                                                <th style="font-size: 10px;">Release Date</th>
                                                <th style="font-size: 10px;">Customer Code</th>
                                                <th style="font-size: 10px;">Destination</th>
                                                <th style="font-size: 10px;">Attention</th>
                                                <th style="font-size: 10px;">Model</th>
                                                <th style="font-size: 10px;">Prod No</th>
                                                <th style="font-size: 10px;">Lot Qty</th>
                                                <th style="font-size: 10px;">shpvia</th>
                                                <th style="font-size: 10px;">JKEI Po Date</th>
                                                <th style="font-size: 10px;">Van Date</th>
                                                <th style="font-size: 10px;">ETD</th>
                                                <th style="font-size: 10px;">ETA</th>
                                                <th style="font-size: 10px;">Ship Via</th>
                                                <th style="font-size: 10px;">Order Item</th>
                                                <th style="font-size: 10px;">Cust PO</th>
                                                <th style="font-size: 10px;">Part Number</th>
                                                <th style="font-size: 10px;">Part Name</th>
                                                <th style="font-size: 10px;">JKN Shelf No</th>
                                                <th style="font-size: 10px;">Demand</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $key => $value)
                                             
                                                <td style="font-size: 12px;"> {{ $value->schcode }}
                                                    <?php if ($value->schcode == null) {
                                                        echo '<span class= "badge text-bg-danger">Generate Failed</span>';
                                                    } ?>
                                              </td>
                                                <td  style="font-size: 12px;"> {{ $value->created_at }}
                                                </td>
                                                <td style="font-size: 12px;"> {{ $value->custcode }}</td>
                                                <td style="font-size: 12px;"> {{ $value->dest }}</td>
                                                <td style="font-size: 12px;"> {{ $value->attention }}</td>
                                                <td style="font-size: 12px;"> {{ $value->model }}</td>
                                                <td style="font-size: 12px;"> {{ $value->prodno }}</td>
                                                <td style="font-size: 12px;"> {{ $value->lotqty }}</td>
                                                <td style="font-size: 12px;"> {{ $value->shipvia }}</td>
                                                <td style="font-size: 12px;">
                                                    {{$value->jkeipodate}}
                                                </td>
                                                <td style="font-size: 12px;"> {{ $value->vandate }}</td>
                                                <td style="font-size: 12px;"> {{ $value->etd }}</td>
                                                <td style="font-size: 12px;"> {{ $value->eta }}</td>
                                                <td style="font-size: 12px;"> {{ $value->shipvia }}</td>
                                                <td style="font-size: 12px;"> {{ $value->orderitem }}</td>
                                                <td style="font-size: 12px;">{{ $value->custpo }} </td>
                                                <td style="font-size: 12px;">{{ $value->partno }} </td>
                                                <td style="font-size: 12px;">{{ $value->partname }} </td>
                                                <td style="font-size: 12px;">{{ $value->jknshelf}} </td>
                                                <td style="font-size: 12px;"> {{ $value->demand }}</td> 

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="collapse mt-4" id="view-dic" hide>
                            <form  action ="{{url('schedule/add_dic')}}" method="post" class="card" enctype="multipart/form-data">
                                @csrf
                            <div class="card-header">
                                  <h3 style="font-size:25px"class="card-title text-primary">ADD DIC</h3>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                      <div class="mb-3 col-6">
                                          <label class="form-label required">DIC Name</label>
                                          <div>
                                            <input type="text" class="form-control"  name="name" id="name" placeholder="Enter NAME" required>
                                          </div>
                                      </div>
                                      <div class="mb-3 col-6">
                                          <label class="form-label required">DIC Email</label>
                                          <div>
                                            <input type="email" class="form-control"  name="email" id="email" placeholder="Enter NIK" required>
                                          </div>
                                      </div>
                                    
                                                       
                                      </div>
                                  </div>
                                 
                                <div class="card-footer text-end">
                                  <button type = "submit"  class="btn btn-info">Submit</button>
                                </div>
                              </form>

                              <div class="card mt-2 mb-2 ">
                                <div class="table-responsive  rounded-1 shadow-sm mt-3 mb-3 ml-0 mr-1 col-12 ">
                                  <table style="width:100%" id="problem-data"  class="table table-vcenter table-striped">
                                      <thead >
                                          <tr class="headings">                                                             
                                              <th style="font-size: 13px;">Name</th>
                                              <th style="font-size: 13px;">Email</th>   
                                              <th style="font-size: 13px;">Created By</th>                  
                                              <th style="font-size: 13px;">Last Updated</th>
                                          </tr>
                                      </thead>
                        
                                      <tbody>
                                          @foreach ($dataemail as $key => $value)             
                                          <td style="font-size: 13px;">{{ $value->name }}</td>
                                          <td style="font-size: 13px;"> {{ $value->email }}</td>
                                          <td style="font-size: 13px;"> {{ $value->inputuser }}</td>            
                                          <td style="font-size: 13px;"> {{ $value->created_at }}</td>                 
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

    {{-- ====================GENERATE PARTLIST========================================= --}}
    <div class="modal modal-blur fade" id="modal-partlist" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PART LIST GENERATE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('schedule/partlist') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label required">PIC </label>
                                    <input class="form-control" name="input_user" id="input_user" placeholder="PIC"
                                        required>
                                    <br>
                                    <select style="font-size:15px" class="form-control col-8 btn btn-light btn-sm"
                                        id="prodno" name="prodno">

                                        @foreach ($data3 as $dd)
                                            <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                                        @endforeach
                                    </select>


                                    <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                                        <i class="ti ti-file-export"></i>
                                        Submit
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
{{-- @endsection
{{-- ====================GENERATE PARTLIST========================================= --}}
    <div class="modal modal-blur fade" id="cancel-partlist" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">CANCEL PARTLIST</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('schedule/cancel_partlist') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label required">PIC </label>
                                    <input class="form-control" name="input_user" id="input_user" placeholder="PIC"
                                        required>
                                    <br>

                                    <input class="form-control" name="prodno" id="prodno" placeholder="INPUT PRODNO"
                                    required>
                                     <br>
                                    {{-- <select style="font-size:15px" class="form-control col-8 btn btn-light btn-sm"
                                        id="prodno" name="prodno">

                                        @foreach ($data3 as $dd)
                                            <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                                        @endforeach
                                    </select> --}}


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

    {{-- ====================GENERATE PARTLIST========================================= --}}
    <div class="modal modal-blur fade" id="check" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">CHECK DATA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('schedule/check_data') }}" method="GET">
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
    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $('#btn-sch').on('click', function(){
                $('#view-dic').hide();
                $('#view-schedule').show();
            })

            
            $('#btn-dic').on('click', function(){
                $('#view-schedule').hide();
                $('#view-dic').show();
            })


            $('#schedule-release').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                    
                        'excelHtml5',
                        'csvHtml5'
                    ]
                } );



            $('#filter-Data').submit(function(event) {

                event.preventDefault();
                var prodNo = $('#prod-no').val();
                // send the AJAX request to the route
                $.ajax({
                    url: "{{ url('/schedule/filter/') }}",
                    method: 'POST',
                    data: {
                        prodno: prodNo,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var data = ""
                        console.log(data);

                        $.each(response, function(key, value) {
                            data = data + "<tr>"

                            data = data + "<td>" + value.schcode + "</td>"
                            data = data + "<td>" + value.created_at + "</td>"
                            data = data + "<td>" + value.custcode + "</td>"
                            data = data + "<td>" + value.dest + "</td>"
                            data = data + "<td>" + value.attention + "</td>"
                            data = data + "<td>" + value.model + "</td>"
                            data = data + "<td>" + value.prodno + "</td>"
                            data = data + "<td>" + value.lotqty + "</td>"
                            data = data + "<td>" + value.jkeipodate + "</td>"
                            data = data + "<td>" + value.vandate + "</td>"
                            data = data + "<td>" + value.etd + "</td>"
                            data = data + "<td>" + value.eta + "</td>"
                            data = data + "<td>" + value.shipvia + "</td>"
                            data = data + "<td>" + value.orderitem + "</td>"
                            data = data + "<td>" + value.custpo + "</td>"
                            data = data + "<td>" + value.partno + "</td>"
                            data = data + "<td>" + value.partname + "</td>"

                            data = data + "<td>" + value.demand + "</td>"


                            data = data + "</tr>"
                        })
                        $('tbody').html(data);
                    }
                });
            });

            //SHARE SCHEDULE DIC//
            $('#share-schedule').on('click', function() {

                $('#example .check:checked').each(function() {
                    selected.push($(this).val());
                });
  
                Swal.fire({
                    icon: 'warning',
                    title: ' Share Update Schedule?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                       
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('/schedule/email') }}",
                            success: function(result) {
                          
                                swal.fire(
                                    'SUCCESS!',
                                    'Share email to DIC',
                                    'success'
                                )
                            }
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swal.fire(
                            'Cancelled',
                            'Cancel Share Schedule :)',
                            'error'
                        )
                    }
                });
            });

            //  =====================GENERATE PARLIST============================


        });
    </script>
@endsection
