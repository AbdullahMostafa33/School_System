@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
         @include('components.confirmation-modal', [
         'modalId' => 'delete_model',
         'title' => __('Confirm delete'),
         'message' => __('Are you sure you want to delete the selected students?')
        ])
        @include('components.confirmation-modal', [
         'modalId' => 'graduate_model',
         'title' => __('Confirm graduate'),
         'message' => __('Are you sure you want to graduate the selected students?')
        ])
    
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
                              <button class="dropdown-item" onclick="exportTableToExcel('myTable', 'students_data', [0, 10])">{{__('Export to Excel')}}</button>
                              <button class="dropdown-item" onclick="submit_form('{{route('students.Selection.delete')}}','delete_model')">{{__('Delete Selection')}}</button>
                              <button class="dropdown-item" onclick="submit_form('{{route('students.graduates')}}','graduate_model')">{{__('Graduate Selection')}}</button>
                            </div>
                          </div>
                        </div>
                      </div>
                       {{-- show errors       --}}
                      @if ($errors->any())
                       <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                       </div>
                       @endif  
                      <!-- table -->

                     <form  id="form_selection" >
                        @csrf  
                      <table id="myTable" class="table table-bordered">
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
                            <th>{{__('Action')}}<form></form></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $i=>$student)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selected-checkbox" id="{{$student->id}}" value="{{$student->id}}" name="students_selected[]" >
                                <label class="custom-control-label" for="{{$student->id}}"></label>
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
                                <form action="{{route('invoices.create')}}">
                                  <button name="id" value="{{$student->id}}"class="dropdown-item edit_btn"> {{__('Create Invoice')}}</button>
                                </form>
                                <form action="{{route('students.destroy',$student->id)}}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <button onclick="showConfirmModal(event, 'delete_model','{{$student->name}}')" class="dropdown-item"  style="color: red">
                                    {{__('Remove')}}</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                           @endforeach
                        </tbody>                                                    
                      </table>
                      </form> {{--  end form delete selection --}}
                      {{-- paginate --}}
                      {{$students->links('components.pagination')}}
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

  function submit_form( action='',model_confirm=''){ 
    showConfirmModal(event, model_confirm)      
    $(document).on('click', '[id$="ConfirmButton"]', function() {
       $('#form_selection').attr({'action':action}) 
       $('#form_selection').submit();    
        });   
  }
  
  </script>  