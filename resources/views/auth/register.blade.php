@include('layouts.header')

    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">

                {{-- form --}}
        <form action="{{ route('register') }}" method="POST" class="col-lg-6 col-md-8 col-10 mx-auto">
          @csrf
          <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
            <h2 class="my-3">{{__('Register')}}</h2>
          </div>
          <div class="form-group">
            <label for="inputEmail4">{{__('Email')}}</label>
            <input type="email" class="form-control" name="email">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">{{__('Name')}}</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="lastname">Lastname</label>
              <input type="text" name="lastname" class="form-control">
            </div>
          </div>
          <hr class="my-4">
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputPassword5">{{__('Password')}}</label>
                <input type="password" class="form-control" name="password">
              </div>
              <div class="form-group">
                <label for="inputPassword6">{{__("Confirm Password")}}</label>
                <input type="password" name="password_confirmation" class="form-control" ">
              </div>
            </div>
            <div class="col-md-6">
              <p class="mb-2">{{__('Password requirements')}}</p>
              <p class="small text-muted mb-2">{{ __('To create a new password, you have to meet all of the following requirements:') }}</p>
              <ul class="small text-muted pl-4 mb-0">
                <li>{{ __('Minimum 8 character') }}</li>
    <li>{{ __('At least one special character') }}</li>
    <li>{{ __('At least one number') }}</li>
    <li>{{ __('Can’t be the same as a previous password') }}</li>
              </ul>
            </div>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">{{__('Sign up')}}</button>
          <center><a href="{{ route('login') }}" >{{__('Already Registered?')}}</a></center>
          <p class="mt-5 mb-3 text-muted text-center">© 2024</p>
        </form>
      </div>
    </div>
  
  </body>
</html>
</body>
</html>