@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
        @include('components.confirmation-modal', [
         'modalId' => 'delete_model',
         'title' => __('Confirmation'),
         'message' => __('Are you sure you want to delete the selected online classes')
        ])

    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Online Classes')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      
                      {{-- second form --}}
                       <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('onlineClass.index')}}" class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_stage" name="stage_id" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Stage')}}</option>  
                                  @foreach ($stages as $stage)
                                      <option value="{{$stage->id}}"
                                        {{request('stage_id')==$stage->id ? 'selected':''}}
                                        >{{$stage->name}}</option>
                                  @endforeach                               
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_grade" name="grade_id" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Grade')}}</option>                                                               
                                </select>
                              </div>
                              <div class="form-group col-auto ml-3">                               
                                <select class="custom-select my-1 mr-sm-2 select_classroom" name="classroom_id" >                                                                                                                              ">
                                  <option disabled selected>{{__('Select Classroom')}}</option>                                 
                                </select>
                              </div>                              
                            <div class="form-group col-auto ml-3">                                
                                <button class="btn btn-secondary">{{__('Filter')}}</button>
                              </div>                          
                          </div>
                          </form> {{-- end  form --}}

                        </div>  
                         <div class="form-group col-auto ml-3">                        
                          <a href="{{route('onlineClass.create')}}"class="btn btn-primary float-right ml-3">{{__('Add Online Class')}}+</a>                          
                         </div>
                      </div>                                        
                     
                      <!-- table -->
                                              
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">                            
                            <th>{{__('ID')}}</th>
                            <th>{{__('Stage')}}</th>
                            <th>{{__('Grade')}}</th>
                            <th>{{__('Classroom')}}</th>
                            <th>{{__('Specialty')}}</th>
                            <th>{{__(' Name')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Start At')}}</th>
                            <th>{{__('Host Link')}}</th>
                            <th>{{__('Join Link')}}</th>
                            <th>{{__('Actions')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($onlineClasses as $i=>$onlineClass)                                                     
                          <tr>                            
                            <td>{{++$i}}</td>
                            <td>{{$onlineClass->grade_id ? $onlineClass->grade->stage->name : __('All Stages')}}</td>
                            <td>{{$onlineClass->grade_id ? $onlineClass->grade->name : __('All Grades')}}</td>
                            <td>{{$onlineClass->classroom_id ? $onlineClass->classroom->name : __('All Classrooms')}}</td>
                            <td>{{$onlineClass->specialty_id ? $onlineClass->specialty->name : __('Global Meeting')}}</td>
                            <td>{{$onlineClass->name}}</td> 
                            <td>{{$onlineClass->title}}</td> 
                            <td>{{$onlineClass->start_at}}</td>
                            <td><a href="{{$onlineClass->start_url}}" target="_blank">{{__('Host Link')}}</a></td>
                            <td><a href="{{$onlineClass->join_url}}" target="_blank">{{__('Join Link')}}</a></td>
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit_btn" href="{{route('onlineClass.show',$onlineClass->id)}}"  >{{__('Show')}}</a>                                
                                <a class="dropdown-item edit_btn" href="{{route('onlineClass.edit',$onlineClass->id)}}"  >{{__('Edit')}}</a>
                                <form action="{{route('onlineClass.destroy',$onlineClass->id)}}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <button class="dropdown-item" onclick="showConfirmModal(event, 'delete_model','{{$onlineClass->name}}')" style="color: red">{{__('Remove')}}</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                           @endforeach
                        </tbody>                                                    
                      </table>
                      
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
        var filter = '{{ request('grade_id') }}'
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
        var filter='{{ request('classroom_id') }}'
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