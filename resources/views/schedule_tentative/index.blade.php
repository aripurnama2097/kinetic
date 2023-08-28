@extends('layouts.main')
 <head>
  
    
</head> 

@section('section')
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      {{-- <div class="container-xl"> --}}
        <div class="row g-2 align-items-center d-flex justify-content-center">
          
          <!-- Page title actions -->
       
            <div class="btn-group col-8 ">
             
                <a  href="{{url('/schedule_tentative/master_scheduleTemp')}}" class="btn btn-light" >
                  Excell Schedule           
                 </a>
                <a  href="{{url('/schedule_tentative/SB98')}}" class="btn btn-light" >
                  SB98 Master                 
                 </a>
                 <a   href="{{url('/schedule_tentative/SA90')}}" class="btn btn-light">
                   SA90 Master
                 </a>
                 <a   href="{{url('/schedule_tentative/inhouse')}}" class="btn btn-primary">
                  Inhouse Master
                 </a>
            </div>
       
        </div>
      </div>
    </div>




    <!-- Page body MENU -->
    
   



</a>
</div>

<script type="text/javascript" src="{{asset ('')}}js/jquery-3.7.0.js "></script>
<script type="text/javascript">




            
$(document).ready(function () {
  $('#sch-tentative').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5',
            'csvHtml5'
        ]
    } );

    
    // CONFIRM SUMMARY SB98
    $('#confirm-sb98').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure summary SB98?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('/schedule_tentative/sumsb98')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Summary Finish.',
                  'success'
                    )
              }
          });
        }
      });
    });

  
    //GENERATE SCHEDULE 
    $('#generate-sch').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
          html:
          '<input id="nik" name="nik" class=" col-8" type="text" placeholder="INPUT NIK" maxlenght="5">',
          icon: 'warning',
          title: ' Generate Schedule?',
          // input :text,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
        
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          nik= $('#nik').val();
          $.ajax({
            type: 'get',
            data:{
                    nik:nik

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('schedule_tentative/generate')}}",    
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


      //GENERATE SCHEDULE 
    $('#reset-all-master').on('click', function() {
      
      $('#example .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: ' Reset Master Upload?',
          // input :text,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
        
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('schedule_tentative/reset_allmaster')}}",    
            success: function(result) {
                    swal.fire(
                  'SUCCESS!',
                  'Reset Master upload',
                  'success'
                    )
              }
          });
        }
      });
    });


// const filterDropdown = document.getElementById("filter");
// const itemList = document.getElementById("example");
// var rows = table.getElementsByTagName("tr");

// filterDropdown.addEventListener("change", function() {
//   const selectedValue = filterDropdown.value;

//   for (let i = 0; i < items.length; i++) {
//     const item = items[i];

//     if (selectedValue === "all" || item.classList.contains(selectedValue)) {
//       item.classList.add("show");
//     } else {
//       item.classList.remove("show");
//     }
//   }
// });


});



</script>




  @endsection