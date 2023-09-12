@extends('layouts.loginMain')

<style>
  body {
     background-image: url(http://136.198.117.7/mcsp/public/css/8.jpg);
     background-color: aliceblue;
    border-radius: 100%;
    background-image:cover;
    -o-background-size: cover;
    background-size: cover;
}
  </style>

@section('container')
{{-- <div class="row justify-content-center">
  <div class="col-md-5">

  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif

   @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session('loginError')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif

   @if(session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session('failed')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif
   

    <main class="form-signin">
      <h1 style="color:aliceblue" class="h3 mb-3 font-weight-normal text-center">Login Form</h1>
    <form action="{{url('/login')}}" method="post">
      @csrf
        <div class="form-floating">
        <input type="text"  name="nik"class="form-control @error('nik')is-invalid @enderror" placeholder="NIK" width="40% mb-lg-5" autofocus required>
         <label for="nik">NIK</label>
          @error('nik')
         <div class="invalid-feedback" style="color:aliceblue">
          
          {{$message}}
         </div>
        @enderror
        </div> 

        <div class="form-floating">
         <input type="password"  name="password"class="form-control" placeholder="Password" width="40% pd-4" required >
        <label for="password">Password</label>
        </div> 

        <br>
        <button type="submit" class="w-100 btn btn-lg  btn-primary">
          Login
        </button>
      </form>
      
       <div class="d-flex justify-content-center">
        <a class="text-center" href="{{url('/login/reset_password')}}">Reset Password!</a>
      </div>
      </small>
    </main>
  </div>
</div> --}}

<div class="container">
  <div class="row my-4">
      <div class="col-md-8 offset-md-2 col-md-offset-2">
          <div class="card card-default ">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session()->has('loginError'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('loginError')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session()->has('failed'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('failed')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
              <div style="font-size:25px" class="card-header ">Login</div>

              <div class="card-body">
                <form action="{{url('/login')}}" method="post">
                  @csrf
                    
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="nik" class="col-md-4 control-label">ID Number</label>

                          <div class="col-md-6">
                            <input type="text"  name="nik"class="form-control @error('nik')is-invalid @enderror" placeholder="NIK" width="40% mb-lg-5" autofocus required>
                           
                             @error('nik')
                            <div class="invalid-feedback" style="color:aliceblue">
                             
                             {{$message}}
                            </div>
                           @enderror
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Password</label>

                          <div class="col-md-6">
                            <input type="password"  name="password"class="form-control" placeholder="Password" width="40% pd-4" required >
                           
                          </div>
                      </div>

                      <div class="form-group mt-2">
                          <div class="col-md-6 col-md-offset-4">
                              {{-- <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                  </label>
                              </div> --}}
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-8 col-md-offset-4">
                              <button type="submit" class="btn btn-info text-white"> <i class="ti ti-login-2"></i>
                                  Login
                              </button>
                           
                              <a class="btn btn-link" href="{{url('/login/reset_password')}}">
                                  Forgot Your Password?
                              </a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection