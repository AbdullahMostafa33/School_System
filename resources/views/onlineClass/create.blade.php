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
                            <strong>{{__("Add Online Class")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('onlineClass.store')}}" method="POST">
                                @csrf                               
                                <div>                                 
                                    <h3>{{__("Online Class information")}}</h3>
                                    <section>
                                         <div class="form-row">
                                             <div class="form-group col-md-3">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <select  class="form-control required" id="select_stage" required>
                                                    <option  disabled selected>{{__('Select Stage')}}</option>
                                                    @foreach($stages as $stage)
                                                         <option value="{{ $stage->id }}">{{ $stage->name }}</option>
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
                                                <label for="specialty_id">{{__('Specialty')}} *</label>
                                                <select  class="form-control required" id="specialty_id" name="specialty_id" required>
                                                    <option  disabled selected>{{__('Select Specialty')}}</option>
                                                    <option value="global">{{__('Global')}}</option>   
                                                    @foreach ($Specilaties as $specialty)
                                                        <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                                                    @endforeach                                                 
                                                </select>
                                            </div> 
                                         </div>   
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">{{__("Name")}} *</label>
                                                 <input name="name" type="text" class="form-control required" id="name"  required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="title">{{__("Title")}} *</label>
                                                 <input name="title" type="text" class="form-control" >
                                             </div>
                                         </div>                                                                          
                                         <div class="form-row">                                            
                                             <div class="form-group col-md-6">
                                                 <label for="duration">{{__("Duration in minutes")}} *</label>
                                                 <input name="duration" type="number" class="form-control required" required>
                                             </div>
                                             
                                             <div class="col-md-6 mb-3">
                                            <label for="date-input1">{{__("Start Date")}} *</label>
                                            <div class="input-group">
                                              <input type="datetime-local" class="form-control required" name="start_at"  aria-describedby="button-addon2" required>                                              
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
                                  <center><button class="btn btn-primary float ml-3">{{__('submit')}}</button></center>
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
              success:function(grades){                               
                var x="<option  disabled selected>{{__('Select Grade')}}</option>"
                x+="<option value='all'>{{__('All Grades')}}</option>";
                grades.forEach(grade => {                  
                 x+="<option value='"+grade.id+"'>"+grade.name+"</option>";
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
                var x="<option  disabled selected>{{__('Select Classroom')}}</option>"
                x+="<option value='all'>{{__('All Classrooms')}}</option>";
                classrooms.forEach(classroom => {                  
                 x+="<option value='"+classroom.id+"'>"+classroom.name+"</option>";
                });
                
                $('#select_classroom').empty()
                $('#select_classroom').append(x);
              },
            })
        })    
</script>