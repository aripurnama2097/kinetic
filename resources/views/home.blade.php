<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kinetic Application</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset ('')}}template/img/favicon.png" rel="icon">
  <link href="{{asset ('')}}template/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --}}

  <!-- Vendor CSS Files -->
  <link href="{{asset ('')}}template/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{asset ('')}}template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset ('')}}template/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset ('')}}template/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset ('')}}template/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{asset ('')}}template/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset ('')}}template/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a> --}}
      </div>
    </div>
  </section>

  @if(Session::has('logout'))
  <p class="alert alert-info">{{Session::get('logout')}}</p>
  @endif
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">HOME<span></span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="{{asset ('')}}template/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          {{-- <li><a class="nav-link scrollto active" href="#hero">Home</a></li> --}}
          {{-- <li><a class="nav-link scrollto" href="{{url('/dashboardMenu')}}">Schedule</a></li>
          <li><a class="nav-link scrollto" href="#services">Kits Services Monitor</a></li> --}}
          {{-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}
          {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                 
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
          {{-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to <span>KINETIC</span></h1>
      <h2>KIT & Service Part Electronics</h2>
      <div class="d-flex">
        <a href="{{url('/login')}}" class="btn-get-started scrollto">Login</a>    
    </div>
  </section>
  <!-- End Hero -->

  <main id="main">
    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">
      </div>

      </div>
    </section><!-- End Featured Services Section -->

    

    
    <!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
   

    <!-- ======= Contact Section ======= -->
   
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="footer-top">
      <div class="container">
        <div class="row">

        
        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>IT Application</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
       
        Designed by <a href="#">IT</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset ('')}}template/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{asset ('')}}template/vendor/aos/aos.js"></script>
  <script src="{{asset ('')}}template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset ('')}}template/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{asset ('')}}template/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{asset ('')}}template/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset ('')}}template/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="{{asset ('')}}template/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset ('')}}template/js/main.js"></script>

</body>

</html>