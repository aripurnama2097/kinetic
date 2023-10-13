@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl ml-2">
              Overview
              <h2 class="page-title text-light"> KIT Shipped Out Monitor </h2>
          </div>
        </div>

        <!-- Page body MENU -->
        {{-- <div class="bg-light mt-3">
            <div class="container-fluid">
              <div class="card ml-3 mr-3 mt-3">
                
                  <div class="card-body">
                  <h2>FILTER </h2>
                  <div class="row">
                    <div class="col-5">
                      <form id="filter-Data">
            
                        <select style="font-size:15px" class="form-control col-3 btn btn-light btn-sm" id="prod-no" name="prodno">
                          <option value="-">-- PROD NO --</option>
                        
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
        </div> --}}
              <div class="card mt-4">
                <div class="container-fluid mt-4">
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class="col-12 ">             
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    <table style="width:100%" id="kit-monitor"  class="table table-vcenter table-striped">
                                        <thead class="thead-primary">
                                            <tr class="headings">                   
                                                <th class="text-center" style="font-size: 13px;">Cust No</th>
                                                <th class="text-center" style="font-size: 13px;">Dest</th>
                                                <th class="text-center" style="font-size: 13px;">Model</th>
                                                <th class="text-center" style="font-size: 13px;">Prod No</th>
                                                <th class="text-center" style="font-size: 13px;">Lot Qty</th>
                                                <th class="text-center" style="font-size: 13px;">JKEI Po Date</th>
                                                <th class="text-center" style="font-size: 13px;">VanDate</th>
                                                <th class="text-center" style="font-size: 13px;">ETD</th>
                                                <th class="text-center" style="font-size: 13px;">ETA</th>
                                                <th class="text-center" style="font-size: 13px;">Shipvia</th>
                                                <th class="text-center" style="font-size: 13px;">Order Item</th>
                                               
                                                <th class="text-center" style="font-size: 13px;">Part No</th>
                                                <th class="text-center" style="font-size: 13px;">Problem</th>
                                        
                                                <th class="text-center" style="font-size: 13px;">Invoice No</th>
                                                <th class="text-center" style="font-size: 13px;">Last Updated</th>
                                                               
                                            </tr>
                                        </thead>
                          
                                        <tbody>
                                            @foreach ($data as $key => $value)             
                                            <td class="text-center" style="font-size: 12px;">{{ $value->custcode }}</td>
                                            <td class="text-center" style="font-size: 12px;">{{ $value->dest }}</td>
                                            <td class="text-center" style="font-size: 12px;"> {{ $value->model }}</td>
                                            <td class="text-center" style="font-size: 12px;"> {{ $value->prodno }}</td>                                         
                                            <td class="text-center text-dark" style="font-size: 13px;font-weight:bold">{{ $value->lot_qty}}</td>             
                                            <td class="text-center" style="font-size: 12px;">{{ $value->jkeipodate }} </td>
                                            <td class="text-center" style="font-size: 12px;">{{ $value->vandate}} </td>
                                            <td class="text-center" style="font-size: 12px;">{{ $value->etd}}  </td>
                                            <td class="text-center" style="font-size: 12px;"> {{ $value->eta}} </td>
                                            <td class="text-center" style="font-size: 12px;"> {{ $value->shipvia}} </td>
                                            <td class="text-center text-dark" style="font-size: 13px;font-weight:bold">{{ $value->orderitem}}  </td>
                                           
                                            <td class="text-center" style="font-size: 12px;"> {{ $value->partno}}</td>                                       
                                            <td class="text-center" style="font-size: 12px;">{{$value->symptom}}</td>
                                            
                                            <td class="text-center text-primary" style="font-size: 13px;font-weight:bold">{{$value->invoice_no}} </td>                                          
                                            <td class="text-dark text-center"   style="font-size: 13px; font-weight:bold"> </td>
                                         
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





    
    
        $(document).ready(function() {


    //         $('#kit-monitor').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
           
    //         'excelHtml5',
    //         'csvHtml5'
    //     ]
    // } );



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
