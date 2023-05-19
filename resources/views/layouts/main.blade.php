<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>KIT Electronics Service</title>
    @include('layouts.css')
  </head>

  
     <!-- Navbar -->
     @include('layouts.navbar')
     {{-- <--end Navbar--> --}}

  <body >
    <script src="./dist/js/demo-theme.min.js?1674944402"></script>
  

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