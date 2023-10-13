@extends('layouts.main')

@section('section')
<div class="page-wrapper">
   
    <div class="col-12 bg-dark">
        <div class="card  ">
            <h2 class="page-title text-primary ml-5"> SCAN OUT - KIT </h2>
          {{-- <div class="card-header">
            <h3 class="card-title">SCAN OUT</h3>
          </div> --}}
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="text-muted">
              
            </div>
          </div>
         
          <div class="table-responsive  rounded-1 shadow-lg mt-2 ">
            {{-- <p class="btn btn-primary btn-sm"style="font-weight:bold;font-size:15px"> Schedule Number: </p>      --}}
            <table style="width:100%" id="schedule-release" class="table table-vcenter table-border mt-4">
               
                <thead class="thead-dark" >
                    <tr class="headings">
                       
                        <th style="font-size: 12px;">Customer Code</th>                                          
                      
                       
                        <th style="font-size: 12px;">Dest</th>
                        <th style="font-size: 12px;">Attent</th>
                        <th style="font-size: 12px;">Model</th>
                        <th style="font-size: 12px;">Prod No</th>
                        <th style="font-size: 12px;">Lot Qty</th>
                        <th style="font-size: 12px;">shpvia</th>
                        <th style="font-size: 12px;">JKEI-Po</th>
                        <th style="font-size: 12px;">VanDate</th>
                        <th style="font-size: 12px;">Order-Item</th>
                        <th style="font-size: 12px;">Cust PO</th>
                        <th style="font-size: 12px;">Part Number</th>
                        <th style="font-size: 12px;">Part Name</th>
                        <th style="font-size: 12px;">Demand</th>
                        <th style="font-size: 12px;">Box No</th>
                        <th style="font-size: 12px;">SKID No</th>
                        <th style="font-size: 12px;">Actual Running</th>
                        <th style="font-size: 12px;">Balance Running</th>
    
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($data as $key => $value)
                     
                    <td class="text-center" style="font-size: 12px;font-weight:bold"> {{ $value->custcode }}</td>
                    {{-- <td class="text-dark text-center" style="font-size: 14px; font-weight:bold">{{ $value->qty_running }} </td> --}}
                   
                 
                 
                        <td class="text-center"style="font-size: 13px;"> {{ $value->dest }}</td>
                        <td class="text-center" style="font-size: 13px;"> </td>
                        <td class="text-center" style="font-size: 13px;"> {{ $value->model }}</td>
                        <td class="text-center" style="font-size: 13px;"> {{ $value->prodno }}</td>
                        <td class="text-center" style="font-size: 13px;"> </td>
                        <td class="text-center" style="font-size: 13px;"> </td>
                        <td class="text-center" style="font-size: 13px;">{{$value->jkeipodate}}</td>
                        <td class="text-center" style="font-size: 13px;"> {{ $value->vandate }}</td>                      
                        <td class="text-center" style="font-size: 13px;"> {{ $value->orderitem }}</td>
                        <td class="text-center" style="font-size: 13px;">{{ $value->custpo }} </td>
                        <td class="text-center" style="font-size: 13px;">{{ $value->partno }} </td>
                        <td class="text-center" style="font-size: 13px;">{{ $value->partname }} </td>    {{-- <td class="text-center" style="font-size: 13px;"> </td> --}}
                        <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                        <td class="text-center" style="font-size: 14px;"> {{ $value->box_no}}</td>
                        <td class="text-center" style="font-size: 14px;"> {{ $value->skid_no}}</td>
                        <td class="text-primary text-center"   style="font-size: 14px; font-weight:bold"> {{ $value->act_running }}</td>
                        <td class="text-danger text-center" style="font-size: 14px;font-weight:bold">{{ $value->bal_running }} </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
         
        </div>
      </div>
    </div>
</div>


    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">





    
    
        $(document).ready(function() {


            $('#schedule-release').DataTable( {
        // dom: 'Bfrtip',
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
