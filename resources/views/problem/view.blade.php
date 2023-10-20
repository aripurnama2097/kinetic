@extends('layouts.main')

@section('section')
    <div class="page-wrapper">
      

            <div class="container-fluid mt-1">
                <h2 class="page-title text-primary"> Problem History </h2>
                    @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                          <div class="col-12 ">                   
                                <div class="table-responsive  rounded-1 shadow-sm">
                                    <table style="width:100%" id="problem-data"  class="table table-vcenter table-striped">
                                        <thead >
                                            <tr class="headings">                   
                                               
                                                <th class="text-center" style="font-size: 10px;">Dest</th>
                                                <th class="text-center" style="font-size: 10px;">Model</th>
                                                <th class="text-center" style="font-size: 10px;">Prod No</th>
                                                {{-- <th class="text-center" style="font-size: 10px;">Lot Qty</th> --}}
                                                <th class="text-center" style="font-size: 10px;">VanDate</th>
                                                {{-- <th class="text-center" style="font-size: 10px;">Via</th> --}}
                                                <th class="text-center" style="font-size: 10px;">Cust PO</th>
                                                <th class="text-center" style="font-size: 10px;">Part Number</th>
                                                <th class="text-center" style="font-size: 10px;">Part Name</th>
                                                <th class="text-center" style="font-size: 10px;">Demand</th>
                                           
                                                <th class="text-center" style="font-size: 10px;">Symptom</th>
                          
                                      
                                                <th class="text-center" style="font-size: 10px;">Time Found</th>
                                                <th class="text-center" style="font-size: 10px;">Found By</th>
                                                <th class="text-center" style="font-size: 10px;">DIC</th>
                                                <th class="text-center" style="font-size: 10px;">Cause</th>
                                                <th class="text-center" style="font-size: 10px;">Action</th>
                                                <th class="text-center" style="font-size: 10px;">Status</th>
                                                <th class="text-center" style="font-size: 10px;">Last Updated</th>
                                            <?php if (Auth::user()->role === 'user' || Auth::user()->role === 'Admin QA' ||Auth::user()->role === 'Admin QC') { ?>
                                                <th class="text-center" style="font-size: 10px;">Response</th>
                                            <?php } ?>
                                            
                          
                                            </tr>
                                        </thead>
                          
                                        <tbody>
                                            @foreach ($data as $key => $value)             
                                            <td style="font-size: 12px;">{{ $value->dest }}</td>
                                            <td style="font-size: 12px;"> {{ $value->model }}</td>
                                            <td style="font-size: 12px;"> {{ $value->prodno }}</td> 
                                            {{-- <td style="font-size: 12px;">{{ $value->lotqty }} </td> --}}
                                            <td style="font-size: 12px;"> {{ $value->vandate }}</td>
                                            {{-- <td style="font-size: 12px;"> {{ $value->shipvia }}</td> --}}
                                            <td style="font-size: 12px;">{{ $value->custpo }} </td>
                                            <td style="font-size: 12px;">{{ $value->partno }} </td>
                                            <td style="font-size: 12px;">{{ $value->partname }} </td>
                                            <td class="text-dark text-center" style="font-size: 14px; font-weight:bold"> {{ $value->demand }}</td> 
                                          
                                            <td style="font-size: 12px;"> {{ $value->symptom }}</td>
                                            {{-- <td style="font-size: 12px;"><img width="30%" class="img-circle" src="{{ url('/public/img') }}"> </td> --}}
                                            <td style="font-size: 12px;">{{$value->created_at}}</td>
                                            <td style="font-size: 12px;">{{$value->found_by}}</td>           
                                            <td style="font-size: 12px;">{{$value->dic}} </td>
                                            <td style="font-size: 12px;">{{$value->cause}} </td>
                                            <td style="font-size: 12px;"> {{$value->action}}</td>
                                            <td class="text-danger text-center" style="font-size: 14px;font-weight:bold"> 
                                                <?php if ($value->status == 'waiting' ) {
                                        
                                                    echo '<span class= "badge bg-danger"><i class="ti ti-clock-pause"></i>WAITING</span>';
                                                  }
                                                  if ($value->status =='Done') {
                                       
                                                      echo '<span class= "badge bg-success">DONE</span>';
                                                  }
                    
                                                  ?> 
    
                                            </td>                                    
                                            <td class="text-primary text-center"   style="font-size: 12px; font-weight:bold">{{$value->updated_at}} </td>
                                            <?php if (Auth::user()->role === 'user' || Auth::user()->role === 'Admin QA' ||Auth::user()->role === 'Admin QC') { ?>
                                            <td  style="font-size: 14px;">                                         
                                                <?php if ($value->status != 'Done'){?>
                                                    <a  class="btn btn-primary btn-sm text-white"  data-toggle="modal" data-target="#updateModal_{{$value->id}}"><i class="ti ti-arrow-big-right-filled"></i>Response</a>
                                                <?php }?>

                                            <div class="modal modal-blur fade" id="updateModal_{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title">Response Problem</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                          <form  action="{{ url('problem/update/' . $value->id) }}"  method="POST" >
                                                            @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Item Number</label>
                                                            <input type="text"  class="form-control"  value="{{$value->part_no}}"  disabled>
                                                        </div>
                                                      
                                                        <div class="mb-3">
                                                            <label class="form-label">Symptom </label>
                                                            <input type="text"  class="form-control"  value="{{$value->symptom}}"  disabled>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                <label class="form-label">DIC</label>
                                                                <input type="text" class="form-control" name="dic" placeholder="INPUT NIK"  required>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                <label class="form-label">Cause</label>
                                                                <input type="text" class="form-control" name="cause"  placeholder="CAUSE" required>
                                                                </div>
                                                            </div>
                                                          
                                                            <br>
                                                            <br>
                                                            <div class="col-lg-12">
                                                                <div>
                                                                <label class="form-label">Action</label>
                                                                <select  class="form-control" name="action"  id="action" required> 
                                                                    <option>Correction</option>
                                                                    <option>RTV</option>
                                                                    <option>Widhtrawl</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>                                                                                                                                          
                                                                                   
                                                        </div>  
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link link-warning" data-bs-dismiss="modal">
                                                            Cancel
                                                          </button>
                                                      <button type="submit" id="update" class="btn btn-primary ms-auto" >
                                                        Submit
                                                      </button>
                                                   </div>                                       
                                                    </form>
                                                   </div>      
                                                  </div>
                                                </div>
                                              </div>
                                            </td> 
                                            <?php } ?>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <a  class="btn btn-secondary btn-sm text-light mt-2" href="{{url('/problem')}}" ><i class="ti ti-arrow-narrow-left"></i>BACK</a>                     
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('') }}js/jquery-3.7.0.js "></script>
    <script type="text/javascript">

        $(document).ready(function() {


            $('#problem-data').DataTable( {
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
