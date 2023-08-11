@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl ml-2">
              Overview
              <h2 class="page-title text-light"> RELEASE SCHEDULE </h2>
          </div>
        </div>

        <!-- Page body MENU -->
        <div class="bg-dark mt-3">
            <div class="container-fluid">
              <div class="card ml-3 mr-3">
                {{-- <div class="card-header"> --}}
                  {{-- </div> --}}
                  <div class="card-body">
                  <h2>FILTER </h2>
                  <div class="row ">
                    <div class="col-12 btn-group">
                      <form id="filter-Data" class="col-9">
            
                        <select style="font-size:15px" class="form-control col-3 btn btn-light btn-sm" id="prod-no" name="prodno">
                          <option value="-">-- PROD NO --</option>
                          @foreach ($data2 as $dd)
                          <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary d-none d-sm-inline-block  ">
                          <i class="ti ti-filter"></i>
                          Search
                        </button>
                      </form>
                        
                   
                    </div>
                  
                 
            </div>
            </div>
            <div class="container-xl mt-1">

                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif

                    {{-- <a href="{{ url('/schedule/release_schedule') }}" class="btn btn-warning ml-2 col-1 mb-2">
                        <i class="ti ti-360"></i>
                        Refresh
                     </a> --}}
                    <div class="col-12 ">
                        <div class="card  col-12 border border-dark">
{{-- 
                            <div class="card-header ml-3 ">
                                <a data-bs-toggle="modal" data-bs-target="#modal-partlist"
                                    class="btn btn-secondary   text-light">
                                    <i class="ti ti-file-export"></i>
                                    Generate Partlist
                                </a>


                                <button id="share-schedule" class="btn btn-info  ml-2">
                                    <i class="ti ti-share"></i>
                                    Share Schedule
                                </button>


                                <a href="{{ url('/schedule') }}" class="btn btn-warning ml-2">
                                    <i class="ti ti-360"></i>
                                    Refresh
                                </a>
                            </div> --}}

                            {{-- </div>   --}}

                            <div class="card-body border-bottom ">
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    {{-- <p class="btn btn-primary btn-sm"style="font-weight:bold;font-size:15px"> Schedule Number: </p>      --}}
                                    <table style="width:50%" id="schedule-release"  class="table  table-bordered border-dark shadow-sm">
                                       
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
                {{-- </div> --}}
            </div>




        </div>
    </div>

    {{-- ====================,modal stdpack upload ========================================= --}}
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
                                    <label>PIC </label>
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

@section('script') --}}
    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">





    
    
        $(document).ready(function() {


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
                    html:
                        '<input id="name1" name="name1" class=" col-8  type="text">' +'<br>'  +
                        '<input id="name2" name="name2" class=" col-8" type="text">' +'<br>'  +
                        '<input id="name3" name="name3" class=" col-8" type="text">' +'<br>'  +
                        '<input id="name4" name="name4" class=" col-8" type="text">' +'<br>'  +
                        '<input id="name5" name="name5" class=" col-8" type="text">',
                    icon: 'warning',
                    title: ' Share Update Schedule?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        name_1= $('#name1').val();
                        name_2= $('#name2').val();
                        name_3= $('#name3').val();
                        name_4= $('#name4').val();
                        name_5= $('#name5').val();

                        $.ajax({
                            type: 'POST',
                            data: {
                                    name1: name_1,
                                    name2: name_2,
                                    name3: name_3,
                                    name4: name_4,
                                    name5: name_5,
                                    _token: '{{ csrf_token() }}'
                                },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('/schedule/email') }}",
                            success: function(result) {
                             
                                console.log(name_1,name_2) 

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
