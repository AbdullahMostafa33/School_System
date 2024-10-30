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
                  <h2 class="h4 mb-1">{{__('Distribute Teachers')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      
                      {{-- second form --}}
                       <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('distribute.specialties.index')}}" class="form-inline">
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
                          <a href="{{route('distribute.specialties.create')}}"class="btn btn-primary float-right ml-3">{{__('Add Ditribute')}}+</a>                          
                          <a href="{{route('distribute.specialties.edit',' ')}}"class="btn btn-primary float-right ml-3">{{__('Edit Distribute')}}</a>
                         </div>
                      </div>                                        
                     
                      <!-- table -->
                                              
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">                            
                            <th>{{__('ID')}}</th>
                            <th>{{__('Specialty')}}</th>
                            <th>{{__('Teacher')}}</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($specialties as $i=>$specialty)                                                     
                          <tr>                            
                            <td>{{++$i}}</td>
                            <td>{{$specialty->name}}</td> 
                            <td>
                              {{$classroom->teacher($specialty->pivot->teacher_id)->name}}
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