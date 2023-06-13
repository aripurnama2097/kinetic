<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>KIT Electronics Service</title>
    @include('layouts.css')
  </head>

  
   

  <body >
   
  

  {{-- ==FOOTER== --}}
  @include('layouts.footer')

    @yield('section')

    @include('layouts.script')
    <script text="javascript/text">
 
      $(document).ready(function () {
          $('#example').DataTable({
              pagingType: 'full_numbers',
          });
      });
    </script>
    

  
  </body>
   
</html>