@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
        @include('components.confirmation-modal', [
         'modalId' => 'moveStudentsModal',
         'title' => __('Confirmation'),
         'message' => __('Are you sure you want to move the selected students?')
        ])

    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Move students')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('students.move')}}" class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">{{__('Search')}}</label>
                                <input type="text" class="form-control" name="search"  placeholder="{{__('Search')}}">
                              </div>                              
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_stage" name="filter_stage" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Stage')}}</option>  
                                  @foreach ($stages as $stage)
                                      <option value="{{$stage->id}}"{{$stage->id==request('filter_stage')?'selected':''}}>
                                        {{$stage->name}}</option>
                                  @endforeach                               
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_grade" name="filter_grade" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Grade')}}</option>                                 
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_classroom" name="filter_classroom" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Classroom')}}</option>                                 
                                </select>
                              </div>                              
                            <div class="form-group col-auto ml-3">                                
                                <button class="btn btn-secondary">{{__('Filter')}}</button>
                              </div>
                          </form>
                          </div>
                        </div>                      
                      </div>
                      {{-- second form --}}
                       <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('students.move')}}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-row">
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_stage" name="move_stage">                                                                                                                              ">
                                  <option disabled selected>{{__('Select Stage')}}</option>  
                                  @foreach ($stages as $stage)
                                      <option value="{{$stage->id}}">{{$stage->name}}</option>
                                  @endforeach                               
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_grade" name="move_grade" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Grade')}}</option>                                                               
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_classroom" name="move_classroom" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Classroom')}}</option>                                 
                                </select>
                              </div>                              
                            <div class="form-group col-auto ml-3">                                
                                <button class="btn btn-secondary" onclick="showConfirmModal(event, 'moveStudentsModal')">{{__('Move')}}</button>
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
                          </tr>
                           @endforeach
                        </tbody>                                                    
                      </table>
                      </form> {{-- end second form --}}
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

  $('.select_stage').change(function(){
    var form = $(this).closest('form');
    var select_value=$(this).val()
    $.ajax({
      url:'{{route('grades.get')}}',
      type:'GET',
      data:{stage_id:select_value},
      async: false,
      success:function(grades){        
        var filter = '{{ request('filter_stage') }}'
        var x='<option disabled selected>{{__('Select Grade')}}</option>'
        grades.forEach(grade => {
          x+=`<option value="${grade.id}" ${(grade.id == filter) ? 'selected' : ''}>${grade.name}</option>`
        });
       form.find('.select_grade').empty().append(x);                   
      }
    })
  })

  $('.select_grade').change(function(){
    var form=$(this).closest('form');
    var select_value=$(this).val()
    $.ajax({
      url:'{{route('classrooms.get')}}',
      type:'GET',
      data:{grade_id:select_value},
      success:function(classrooms){
        var filter='{{ request('filter_classroom') }}'
        var x='<option disabled selected>{{__('Select Classroom')}}</option>'
        classrooms.forEach(classroom => {
          x+=`<option value="${classroom.id}" ${(classroom.id==filter) ? 'selected':''}>${classroom.name}</option>`
          console.log(x);
          
        });
        form.find('.select_classroom').empty().append(x)                  
      }
    })
  })   
  
   // done when reload page after filter  :
  var selectedStage = $('.select_stage').val();
    if (selectedStage) {
        $('.select_stage').trigger('change');  // Trigger the change event        
    }
  var selectedGrade=$('.select_grade').val()
   if(selectedGrade){  
    $('.select_grade').trigger('change')    
     }
  
 </script>   