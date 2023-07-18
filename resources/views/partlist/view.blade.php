@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl ml-2">
              Overview
              <h2 class="page-title text-light"> MC Data </h2>
          </div>
        </div>

        <!-- Page body MENU -->
        <div class="bg-light mt-3">
            <div class="container-fluid">
              <div class="card ml-3 mr-3 mt-3">
                {{-- <div class="card-header"> --}}
                  {{-- </div> --}}
                  <div class="card-body">
                  <h2>FILTER </h2>
                  <div class="row">
                    <div class="col-5">
                      <form id="filter-Data">
            
                        <select style="font-size:15px" class="form-control col-3 btn btn-light btn-sm" id="prod-no" name="prodno">
                          <option value="-">-- PROD NO --</option>
                          {{-- @foreach ($data2 as $dd)
                          <option value="{{ $dd->prodno }}">{{ $dd->prodno }}</option>
                          @endforeach --}}
                        </select>
                        <button type="submit" class="btn btn-primary d-none d-sm-inline-block  ">
                          <i class="ti ti-filter"></i>
                          Search
                        </button>
                      </form>
                    </div>


                  </div>
                 
                </div>
            </div>
            </div>
            <div class="container-fluid mt-1">

                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif


                    <div class="col-12 ">
                     
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    {{-- <p class="btn btn-primary btn-sm"style="font-weight:bold;font-size:15px"> Schedule Number: </p>      --}}
                                    <table style="width:100%" id="mc-data"  class="table table-vcenter table-striped">
                                        <thead >
                                            <tr class="headings">    
                                                <th class="text-center" style="font-size: 10px;">Cust code</th>
                                                <th class="text-center" style="font-size: 10px;">Dest</th>
                                                <th class="text-center" style="font-size: 10px;">Model</th>
                                                <th class="text-center" style="font-size: 10px;">Prod No</th>
                                                {{-- <th class="text-center" style="font-size: 10px;">Lot Qty</th> --}}
                                                <th class="text-center" style="font-size: 10px;">VanDate</th>
                                                {{-- <th class="text-center" style="font-size: 10px;">Shipvia</th> --}}
                                                <th class="text-center" style="font-size: 10px;">Order Item</th>
                                                <th class="text-center" style="font-size: 10px;">Cust PO</th>
                                                <th class="text-center" style="font-size: 10px;">Part Number</th>
                                                <th class="text-center" style="font-size: 10px;">Part Name</th>
                                                <th class="text-center" style="font-size: 10px;">Shelfno</th>
                                                <th class="text-center" style="font-size: 10px;">Suppliername</th>
                                                <th class="text-center" style="font-size: 10px;">Demand</th>                                         
                                                <th class="text-center" style="font-size: 10px;">Stdpack</th>
                                                <th class="text-center" style="font-size: 10px;">Actual Scan</th>
                                                <th class="text-center" style="font-size: 10px;">Balance Issue</th>
                                                <th class="text-center" style="font-size: 10px;">Last Updated</th>
                                            </tr>
                                        </thead>
                          
                                        <tbody>
                                            @foreach ($data as $key => $value)    
                                            <td class="text-center" style="font-size: 14px;">{{ $value->custcode}}</td>         
                                            <td class="text-center" style="font-size: 14px;">{{ $value->dest }}</td>
                                            <td class="text-center" style="font-size: 14px;"> {{ $value->model }}</td>
                                            <td class="text-center" style="font-size: 14px;"> {{ $value->prodno }}</td>                                     
                                            {{-- <td class="text-center" style="font-size: 14px;"> {{ $value->lotqty}}</td> --}}
                                            <td class="text-center" style="font-size: 14px;"> {{ $value->vandate }}</td>
                                            {{-- <td class="text-center" style="font-size: 14px;"> {{ $value->shipvia}}</td> --}}
                                            <td class="text-center" style="font-size: 14px;"> {{ $value->orderitem }}</td>
                                
                                            <td class="text-center" style="font-size: 14px;">{{ $value->custpo }} </td>
                                            <td class="text-center" style="font-size: 14px;">{{ $value->partno }} </td>
                                            <td class="text-center" style="font-size: 14px;">{{ $value->partname }} </td>                                        
                                            <td class="text-center" style="font-size: 14px;">{{ $value->mcshelfno }} </td>  
                                            <td class="text-center" style="font-size: 14px;">{{ $value->vendor }} </td>  
                                            <td class="text-center"  style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td>  
                                            <td class="text-center" style="font-size: 14px;">{{ $value->stdpack }} </td>  
                                            <td class="text-center" style="font-size: 14px;">{{ $value->tot_scan }} </td>  
                                            <td class="text-center text-danger" style="font-size: 14px;">{{ $value->balance_issue}} </td>  
                                            <td class="text-center" style="font-size: 14px;"> {{ $value->updated_at }}</td>                             
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <a  class="btn btn-success btn-sm text-light mt-2" href="{{url('/partlist')}}" ><i class="ti ti-arrow-narrow-left"></i>BACK</a>
                       
                        </div>
                    </div>
                {{-- </div> --}}
            </div>




        </div>
    </div>


    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">





    
    
        $(document).ready(function() {


            $('#mc-data').DataTable( {
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
