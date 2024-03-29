<style>
<style>
  .bg-dark{
    background-color: #10717d
}

</style>

{{-- <nav class="navbar navbar-expand-lg navbar-dark "> --}}
  <nav class="card-header text-white bg-dark panel-heading " >
    
  <div class="container">
    <a style="font-size:30px;font-weight:bold"class="navbar-brand text-info" href="#"> 
      <i class="ti ti-device-desktop"></i> 
     
  
    {{-- <img style="max-width: 30px" src ="{{asset('../public/css/1.jpg')}}"> </img>  --}}
    {{-- KINETIC --}}
   </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <form class="d-flex">
        <ion-icon name="log-out-outline"></ion-icon>
      </form>

      <ul class="navbar-nav ms-auto">
      @auth
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{url('/logout')}}" method="post">
                @csrf
                <button type="submit" class="dropdown-item"> <i class="bi bi-box-arrow-left">
                  </i>Logout</a></button>
              </form>
            </li>
          </ul>
        </li>
      @else
       <li class="nav-item">
           <a href="{{url('')}}" class="nav-link">
            <i class="bi bi-arrow-left-square"></i>
              Back To Home
          </a>
      </li>
      @endauth
    </ul>

    </div>
  
    <div class="align-self-end d-flex justify-content-end">
      <div class="text-end upgrade-btn">
          <img src ="{{asset('../public/css/logojkei.png')}}" alt="Logo JKEI" width="200px">
      </div>
    </div>
  </div>
 

  
</nav>



 <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action ="{{url('/logout')}}" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </form>
    </div>
