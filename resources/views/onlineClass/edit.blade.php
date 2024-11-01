@include('layouts.header')
<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header">
                            <strong>{{__("Update Online Class")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('onlineClass.update',$onlineClass->id)}}" method="POST">
                                @csrf   
                                @method('PUT')
                                <div>                                 
                                    <h3>{{__("Online Class information")}}</h3>
                                    <section>
                                         <div class="form-row">
                                             <div class="form-group col-md-3">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <select  class="form-control required" id="select_stage" required>
                                                    <option  disabled selected>{{__('Select Stage')}}</option>
                                                    @foreach($stages as $stage)
                                                         <option value="{{ $stage->id }}"
                                                            @if ($onlineClass->grade)
                                                             {{ $onlineClass->grade->stage_id == $stage->id ? 'selected' : '' }}
                                                            @endif
                                                            >{{ $stage->name }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="classroom_id">{{__('Grade')}} *</label>
                                                <select  class="form-control required" id="select_grade" name="grade_id" required>
                                                    <option  disabled selected>{{__('Select Grade')}}</option>                                                    
                                                </select>
                                            </div>
                                             <div class="form-group col-md-3">
                                                <label for="classroom_id">{{__('Classroom')}} *</label>
                                                <select name="classroom_id" class="form-control required" id="select_classroom" required>
                                                    <option  disabled selected>{{__('Select Classroom')}}</option>
                                                    
                                                </select>
                                            </div> 
                                             <div class="form-group col-md-3">
                                                <label for="specialty_id">{{__('Specilaty')}} *</label>
                                                <select  class="form-control required" id="specialty_id" name="specialty_id" required>
                                                    <option  disabled selected>{{__('Select Specilaty')}}</option>
                                                    <option value="global" {{ $onlineClass->specialty_id ? '' : 'selected' }}>{{__('Global')}}</option>   
                                                    @foreach ($Specilaties as $specialty)
                                                        <option value="{{$specialty->id}}" 
                                                            @if ($onlineClass->specialty_id)
                                                                {{ $onlineClass->specialty_id == $specialty->id ? 'selected' : '' }}
                                                            @endif
                                                            >{{$specialty->name}}</option>
                                                    @endforeach                                                 
                                                </select>
                                            </div> 
                                         </div>   
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">{{__("Name")}} *</label>
                                                 <input name="name" type="text" class="form-control required" id="name" value="{{$onlineClass->name}}" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="title">{{__("Title")}} *</label>
                                                 <input name="title" type="text" class="form-control" value="{{$onlineClass->title}}">
                                             </div>
                                         </div>                                                                          
                                         <div class="form-row">                                            
                                             <div class="form-group col-md-6">
                                                 <label for="duration">{{__("Duration in minutes")}} *</label>
                                                 <input name="duration" type="number" class="form-control required" value="{{$onlineClass->duration}}" required>
                                             </div>
                                             
                                             <div class="col-md-6 mb-3">
                                            <label for="date-input1">{{__("Start Date")}} *</label>
                                            <div class="input-group">
                                              <input type="datetime-local" class="form-control required" name="start_at" value="{{$onlineClass->start_at}}" aria-describedby="button-addon2" required>                                              
                                            </div>
                                          </div>                                             
                                         </div> 
                                                                           
                                        <div class="help-text text-muted" >(*) Mandatory fields 
                                         <div class="error_show">
                                            @if ($errors->any())
                                               <div class="alert alert-danger">
                                                   <ul>
                                                       @foreach ($errors->all() as $error)
                                                           <li>{{ $error }}</li>
                                                       @endforeach
                                                   </ul>
                                               </div>
                                           @endif
                                            
                                         </div>
                                        </div>
                                    </section>                                 
                                  <center><button class="btn btn-primary float ml-3">{{__('Update')}}</button></center>
                                </div>
                            </form>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('layouts.footer')
<script>
     // script for select

     $('#select_stage').change(function(){
            var select_value=$(this).val()           
             $.ajax({
              url:"{{route('grades.get')}}",
              type:'GET',
              data:{stage_id:select_value},
              async:false,
              success:function(grades){
                selected_grade='{{$onlineClass->grade_id}}';                               
                var x="<option  disabled selected>{{__('Select Grade')}}</option>"
                x+=`<option value='all' ${selected_grade ? '' : 'selected'}>{{__('All Grades')}}</option>`;
                grades.forEach(grade => {                  
                 x+=`<option value='${grade.id}' ${grade.id == selected_grade ? 'selected' : ''}>${grade.name}</option>`
                });
                
                $('#select_grade').empty()
                $('#select_grade').append(x);
              },
            })
        })
     $('#select_grade').change(function(){
            var select_value=$(this).val()           
             $.ajax({
              url:"{{route('classrooms.get')}}",
              type:'GET',
              data:{grade_id:select_value},
              success:function(classrooms){   
                selected_classroom='{{$onlineClass->classroom_id}}'
                var x="<option  disabled selected>{{__('Select Classroom')}}</option>"
                x+=`<option value='all' ${selected_classroom ? '' : 'selected'}>{{__('All Classrooms')}}</option>`;
                classrooms.forEach(classroom => {                  
                    x+=`<option value='${classroom.id}' ${classroom.id == selected_classroom ? 'selected' : ''}>${classroom.name}</option>`
                });
                
                $('#select_classroom').empty()
                $('#select_classroom').append(x);
              },
            })
        })
          
        if( $('#select_stage').val()){
            $('#select_stage').trigger('change');
        }  
        
        if( $('#select_grade').val()){
            $('#select_grade').trigger('change');
        }  
</script>