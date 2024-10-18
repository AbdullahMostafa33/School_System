@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Academic students')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('students.index')}}" class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">{{__('Search')}}</label>
                                <input type="text" class="form-control" name="search"  placeholder="{{__('Search')}}">
                              </div>                              
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2" name="filter_by" id="filter_by">                                                                                                                              ">
                                  <option disabled selected>{{__('Filter BY')}}</option>
                                  <option value="stage">stage</option>
                                  <option value="grade">grade</option>
                                  <option value="classroom">classroom</option>
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2" name="filter_value" id="filter_value">                                                                                                                              ">
                                  <option disabled selected>{{__('Select')}}</option>                                  
                                </select>
                              </div>
                            <div class="form-group col-auto ml-3">                                
                                <button class="btn btn-secondary">{{__('Filter')}}</button>
                              </div>
                          </form>
                          </div>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            <a class="btn btn-primary float-right ml-3"  href="{{route('students.create')}}">{{__('Add Student')}} +</a>
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
                            <th>{{__('Stage')}}</th>
                            <th>{{__('Grade')}}</th>
                            <th>{{__('Classroom')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th> 
                            <th>{{__('Action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $i=>$student)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="4574">
                                <label class="custom-control-label" for="4574"></label>
                              </div>
                            </td>
                            <td>{{++$i}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->national_id}}</td>
                            <td>{{$student->classroom->grade->stage->name}}</td>
                            <td>{{$student->classroom->grade->name}}</td>
                            <td>{{$student->classroom->name}}</td>
                            <td>{{$student->address}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td> 
                                                     
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit_btn" href="{{route('students.show',$student->id)}}"  >{{__('Show')}}</a>                                
                                <a class="dropdown-item edit_btn" href="{{route('students.edit',$student->id)}}"  >{{__('Edit')}}</a>
                                <form action="{{route('students.destroy',$student->id)}}" method="POST">
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
<script>
  $('#filter_by').change(function(){
    var select_value=$(this).val()
     x=`<option disabled selected>{{__('Select ${select_value}')}}</option>`
    
    if(select_value=='stage'){
      var stages=@json($stages);
      stages.forEach(stage => {
      x += `<option value='${stage.id}'>${stage.name} </option>`;
    });   
    }
    else if(select_value=='grade'){
      grades=@json($grades);
      grades.forEach(grade => {
      x += `<option value='${grade.id}'>${grade.name} of ${grade.stage.name}</option>`;
    }); 
    }
    else if (select_value=='classroom'){
      classrooms=@json($classrooms);
      classrooms.forEach(classroom => {
      x += `<option value='${classroom.id}'>${classroom.name} of ${classroom.grade.name}</option>`})
    }

    $('#filter_value').empty()
    $('#filter_value').append(x)
  })

  </script>   