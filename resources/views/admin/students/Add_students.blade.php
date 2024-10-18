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
                            <strong>{{__("Add Student")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('students.store')}}" method="POST">
                                @csrf                               
                                <div>
                                    <!-- Student Account Section -->
                                    <h3>Student Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label> {{__('Student Email')}} *</label>
                                            <input  name="email" type="text" class="form-control required" >
                                        </div>
                                        <div class="form-group">
                                            <label for="password">{{__('Password')}} *</label>
                                            <input id="password" name="password" type="password" class="form-control required">
                                        </div>                                                                             
                                    </section>

                                    <!-- Student Profile Section -->
                                    <h3>Student Profile</h3>
                                    <section>
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">Name *</label>
                                                 <input name="name" type="text" class="form-control required" id="name"  required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">Address</label>
                                                 <input name="address" type="text" class="form-control" >
                                             </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="phone">Phone *</label>
                                                 <input name="phone" type="text" class="form-control required" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="religion">Religion</label>
                                                 <select name="religion" class="form-control" id="religion">
                                                     <option  disabled selected>{{__('Select Religion')}}</option>
                                                     <option value="1">Muslim</option>
                                                     <option value="2" >Christian</option>                                                     
                                                 </select>
                                             </div>
                                         </div>                                     
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="nationality">Nationality *</label>
                                                 <select name="nationality" class="form-control required" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->name }}" >{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="national_id">National ID *</label>
                                                 <input name="national_id" type="text" class="form-control required" required>
                                             </div>
                                               <div class="form-group col-md-6">
                                                 <label for="religion">Gender</label>
                                                 <select name="gender" class="form-control" >
                                                     <option  disabled selected>{{__('Select Gender')}}</option>
                                                     <option value="0" >Male</option>
                                                     <option value="1" >Female</option>                                                     
                                                 </select>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                              <label for="date-input1">{{__("Parent National ID")}} *</label>
                                              <div class="input-group">
                                              <input type="text" class="form-control required" name="parent_national_id"  aria-describedby="button-addon2" required>                                              
                                              </div>
                                             </div> 
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <select  class="form-control required" id="select_stage" required>
                                                    <option  disabled selected>{{__('Select Stage')}}</option>
                                                    @foreach($stages as $stage)
                                                         <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Grade')}} *</label>
                                                <select  class="form-control required" id="select_grade" required>
                                                    <option  disabled selected>{{__('Select Grade')}}</option>                                                    
                                                </select>
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Classroom')}} *</label>
                                                <select name="classroom_id" class="form-control required" id="select_classroom" required>
                                                    <option  disabled selected>{{__('Select Classroom')}}</option>
                                                    
                                                </select>
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
                classrooms.forEach(classroom => {                  
                 x+="<option value='"+classroom.id+"'>"+classroom.name+"</option>";
                });
                
                $('#select_classroom').empty()
                $('#select_classroom').append(x);
              },
            })
        })    
</script>