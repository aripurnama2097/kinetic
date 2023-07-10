@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl ml-2">
              Overview
              <h2 class="page-title text-light"> SCAN IN - KIT </h2>
          </div>
        </div>

        <!-- Page body MENU -->
        <div class="bg-dark mt-3">
            <div class="container-fluid">
             
            </div>
            <div class="container-fluid mt-1">

                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif


                    <div class="col-12 ">
                        <div class="card  col-12 ">

                            {{-- <div class="card-header ml-3 ">
                                <a data-bs-toggle="modal" data-bs-target="#modal-partlist"
                                    class="btn btn-secondary   text-light">
                                    <i class="ti ti-file-export"></i>
                                    Generate Partlist
                                </a>


                                <button id="share-schedule" class="btn btn-info  ml-2">
                                    <i class="ti ti-share"></i>
                                    Share Schedule
                                </button>


                              
                            </div> --}}

                            {{-- </div>   --}}

                            <div class="card-body border-bottom ">
                                <a href="{{ url('/repacking/kitdata') }}" class="btn btn-primary ml-2 mb-3">
                                    <i class="ti ti-360"></i>
                                    Refresh
                                </a>
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    {{-- <p class="btn btn-primary btn-sm"style="font-weight:bold;font-size:15px"> Schedule Number: </p>      --}}
                                    <table style="width:100%" id="schedule-release"  class="table table-vcenter table-striped">
                                       
                                        <thead class="thead-dark">
                                            <tr class="headings">
                                               
                                                <th style="font-size: 10px;">Customer Code</th>
                                                {{-- <th style="font-size: 10px;">Qty Receive</th> --}}
                                                <th style="font-size: 10px;">Dest</th>
                                                <th style="font-size: 10px;">Attent</th>
                                                <th style="font-size: 10px;">Model</th>
                                                <th style="font-size: 10px;">Prod No</th>
                                                <th style="font-size: 10px;">Lot Qty</th>
                                                <th style="font-size: 10px;">shpvia</th>
                                                <th style="font-size: 10px;">JKEI-Po</th>
                                                <th style="font-size: 10px;">VanDate</th>
                                                {{-- <th style="font-size: 10px;">ETD</th>
                                                <th style="font-size: 10px;">ETA</th>
                                                <th style="font-size: 10px;">Ship Via</th> --}}
                                                <th style="font-size: 10px;">Order-Item</th>
                                                <th style="font-size: 10px;">Cust PO</th>
                                                <th style="font-size: 10px;">Part Number</th>
                                                <th style="font-size: 10px;">Part Name</th>
                                                <th style="font-size: 10px;">JKN Shelf No</th>
                                                <th style="font-size: 10px;">Demand</th>
                                                <th style="font-size: 10px;">Actual Receive</th>
                                                <th style="font-size: 10px;">Balance Receive</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $key => $value)
                                             
                                            <td style="font-size: 12px;"> {{ $value->custcode }}</td>
                                            {{-- <td class="text-dark text-center" style="font-size: 14px; font-weight:bold">{{ $value->qty_receive }} </td> --}}
                                            <td style="font-size: 12px;"> {{ $value->dest }}</td>
                                            <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;"> {{ $value->model }}</td>
                                                <td style="font-size: 12px;"> {{ $value->prodno }}</td>
                                                <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;">
                                                    {{$value->jkeipodate}}
                                                </td>
                                                <td style="font-size: 12px;"> {{ $value->vandate }}</td>
                                                {{-- <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;"> </td>
                                                <td style="font-size: 12px;"></td> --}}
                                                <td style="font-size: 12px;"> {{ $value->orderitem }}</td>
                                                <td style="font-size: 12px;">{{ $value->custpo }} </td>
                                                <td style="font-size: 12px;">{{ $value->partno }} </td>
                                                <td style="font-size: 12px;">{{ $value->partname }} </td>
                                                <td style="font-size: 12px;"> </td>
                                                <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                                                <td class="text-primary text-center"   style="font-size: 14px; font-weight:bold"> {{ $value->act_receive }}</td>
                                                <td class="text-danger text-center" style="font-size: 14px;">{{ $value->bal_receive }} </td> 
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
                        '<input id="name1" name="name1" class=" col-8 row-cols-5" type="text">' +'<br>'  +
                        '<input id="name2" name="name2" class=" col-8" type="text">',
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

                        $.ajax({
                            type: 'POST',
                            data: {
                                    name1: name_1,
                                    name2: name_2,
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
