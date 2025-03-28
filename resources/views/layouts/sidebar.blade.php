<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/dashboard">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="/dashboard"><span class="ml-1 item-text">Default</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-analytics.html"><span class="ml-1 item-text">Analytics</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-sales.html"><span class="ml-1 item-text">E-commerce</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-saas.html"><span class="ml-1 item-text">Saas Dashboard</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-system.html"><span class="ml-1 item-text">Systems</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Components</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">{{__('Academic stages')}}</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{route('stage.index')}}"><span class="ml-1 item-text">manage stage</span></a>
                </li>
                @foreach ($stages as $stage)
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{route('stage.index')}}"><span class="ml-1 item-text">{{$stage->name}}</span></a>
                </li>
                @endforeach             
              </ul>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="{{route('grades.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Academic Grades')}}</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="{{route('classrooms.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Classrooms')}}</span>
              </a>
            </li>
             <li class="nav-item dropdown">
              <a href="#specialties_element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">{{__('Academic Specialties')}}</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="specialties_element">
                <li class="nav-item w-100">
                 <a class="nav-link" href="{{route('specialties.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Specialties')}}</span>
              </a>
            </li>
                <li class="nav-item w-100">
              <a class="nav-link" href="{{route('distribute.specialties.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Distribute Specialties')}}</span>
              </a>
            </li>                                                          
              </ul>
              <li class="nav-item w-100">
              <a class="nav-link" href="{{route('fees.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Manage Fees')}}</span>
              </a>
            </li>  
           <li class="nav-item w-100">
              <a class="nav-link" href="{{route('parents.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Manage Parents')}}</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="{{route('teachers.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Manage Teachers')}}</span>
              </a>
            </li>            
            <li class="nav-item dropdown">
              <a href="#student_elment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">{{__('Academic Students')}}</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="student_elment">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{route('students.index')}}"><span class="ml-1 item-text">{{__("Manage Students")}}</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{route('students.move')}}"><span class="ml-1 item-text">{{__("Move Students")}}</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{route('students.graduates.show')}}"><span class="ml-1 item-text">{{__("Graduated Students")}}</span></a>
                </li>                                          
              </ul>
              <li class="nav-item w-100">
              <a class="nav-link" href="{{route('fees.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Manage Fees')}}</span>
              </a>
            </li>  
            <li class="nav-item w-100">
              <a class="nav-link" href="{{route('invoices.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Manage Invoices')}}</span>
              </a>
            </li>  
            </li>  
            <li class="nav-item dropdown">
              <a href="#online_element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">{{__('Online Class')}}</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="online_element">   
                <li class="nav-item w-100">
                 <a class="nav-link" href="{{route('onlineClass.index')}}">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">{{__('Online Class')}}</span>
              </a>
            </li>       
          </ul>
          <div class="btn-box w-100 mt-4 mb-1">
            <a href="https://themeforest.net/item/tinydash-bootstrap-html-admin-dashboard-template/27511269" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
              <i class="fe fe-shopping-cart fe-12 mx-2"></i><span class="small">Buy now</span>
            </a>
          </div>
        </nav>
      </aside>