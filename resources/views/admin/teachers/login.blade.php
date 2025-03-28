@include('layouts.header')

    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        {{-- form --}}

        <form action="{{route('teacher.login')}}" method="POST" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
            @csrf
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg>
          </a>
          <h1 class="h6 mb-3">{{__("Sign in teacher")}}</h1>
          <div class="form-group">
            <label for="inputEmail" class="sr-only">{{__('Email')}}</label>
            <input type="email" name="email" class="form-control form-control-lg" placeholder="{{__('Email')}}" required="" autofocus="">
          </div>
          @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
          @endif
          <div class="form-group">
            <label for="inputPassword" class="sr-only">{{__("Password")}}</label>
            <input type="password" name="password" class="form-control form-control-lg" placeholder="{{__("Password")}}" required="">
          </div>
          <div class="checkbox mb-3">
            <input type="checkbox" value="remember-me">
            <label>{{__('remember-me')}} </label> 
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">{{__("Let me in")}}</button>
          <center><a href="{{ route('admin.password.request') }}">{{__("forget password ?")}}</a></center>
          <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>
</body>
</html>