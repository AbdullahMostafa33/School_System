@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Academic teachers')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('teachers.index')}}" class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">{{__('Search')}}</label>
                                <input type="text" class="form-control" name="search"  placeholder="{{__('Search')}}">
                              </div>
                              <div class="form-group col-auto ml-3">
                                <label class="my-1 mr-2 sr-only" for="inlineFormCustomSelectPref">Status</label>                                
                                <button class="btn btn-secondary">{{__('Search')}}</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            <a class="btn btn-primary float-right ml-3"  href="{{route('teachers.create')}}">{{__('Add Teacher')}} +</a>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('Action')}} </button>
                            <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                              <a class="dropdown-item" href="#">Export</a>
                              <a class="dropdown-item" href="#">Delete</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">
                            <th>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="all">
                                <label class="custom-control-label" for="all"></label>
                              </div>
                            </th>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('National ID')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th> 
                            <th>{{__('Specialty')}}</th>  
                            <th>{{__('Action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($teachers as $i=>$teacher)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selected-checkbox" id="{{$teacher->id}}" value="{{$teacher->id}}" name="teachers_selected[]" >
                                <label class="custom-control-label" for="{{$teacher->id}}"></label>
                              </div>
                            </td>
                            <td>{{++$i}}</td>
                            <td>{{$teacher->name}}</td>
                            <td>{{$teacher->national_id}}</td>
                            <td>{{$teacher->address}}</td>
                            <td>{{$teacher->email}}</td>
                            <td>{{$teacher->phone}}</td> 
                            <td>
                            @foreach ($teacher->specialties as $specialty)
                                &nbsp;{{$specialty->name}}&nbsp; -
                            @endforeach  
                            </td>                           
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit_btn" href="{{route('teachers.show',$teacher->id)}}"  >{{__('Show')}}</a>                                
                                <a class="dropdown-item edit_btn" href="{{route('teachers.edit',$teacher->id)}}"  >{{__('Edit')}}</a>
                                <form action="{{route('teachers.destroy',$teacher->id)}}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <button class="dropdown-item"  style="color: red">{{__('Remove')}}</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                           @endforeach
                        </tbody>                                                    
                      </table>
                      <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-end mb-0">
                          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                      </nav>
                    </div>
              
              
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->         
             

     

      </main> <!-- main -->
    </div> <!-- .wrapper -->
        
        @include('layouts.footer')
   