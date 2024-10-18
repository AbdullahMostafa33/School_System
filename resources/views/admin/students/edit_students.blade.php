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
                            <form  action="{{route('students.update',$student->id)}}" method="POST">
                                @csrf 
                                @method('PUT')                              
                                <div>
                                    <!-- Student Account Section -->
                                    <h3>Student Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label> {{__('Student Email')}} *</label>
                                            <input  name="email" type="text"  value="{{$student->email}}" class="form-control required" >
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
                                                 <input name="name" type="text" value="{{$student->name}}" class="form-control required" id="name"  required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">Address</label>
                                                 <input name="address" type="text" value="{{$student->address}}" class="form-control" >
                                             </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="phone">Phone *</label>
                                                 <input name="phone" type="text" value="{{$student->phone}}" class="form-control required" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="religion">Religion</label>
                                                 <select name="religion" class="form-control" id="religion">
                                                     <option  disabled selected>{{__('Select Religion')}}</option>
                                                     <option value="1" {{$student->religion==1?'selected':''}}>Muslim</option>
                                                     <option value="2" {{$student->religion==2?'selected':''}} >Christian</option>                                                     
                                                 </select>
                                             </div>
                                         </div>                                     
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="nationality">Nationality *</label>
                                                 <select name="nationality" class="form-control required" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->name }}" {{$student->nationality==$nationality->name?"selected":''}} >{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="national_id">National ID *</label>
                                                 <input name="national_id" type="text" value="{{$student->national_id}}" class="form-control required" required>
                                             </div>
                                               <div class="form-group col-md-6">
                                                 <label for="religion">Gender</label>
                                                 <select name="gender" class="form-control" >
                                                     <option  disabled selected>{{__('Select Gender')}}</option>
                                                     <option value="0" {{$student->gender==0?'selected':''}}>Male</option>
                                                     <option value="1" {{$student->gender==1?'selected':''}}>Female</option>                                                     
                                                 </select>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                              <label for="date-input1">{{__("Parent National ID")}} *</label>
                                              <div class="input-group">
                                              <input type="text" class="form-control required"value="{{$student->parent->national_id}}" name="parent_national_id"  aria-describedby="button-addon2" required>                                              
                                              </div>
                                             </div> 
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <select  class="form-control required" id="select_stage" required>
                                                    <option  disabled selected>{{__('Select Stage')}}</option>
                                                    @foreach($stages as $stage)
                                                         <option value="{{ $stage->id }}"  {{$student->classroom->grade->stage->id==$stage->id?'selected':''}}>{{ $stage->name }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Grade')}} *</label>
                                                <select  class="form-control required" id="select_grade" required>
                                                    <option  disabled selected>{{__('Select Grade')}}</option>
                                                    <option  selected>{{$student->classroom->grade->name}}</option>                                                   
                                                </select>
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Classroom')}} *</label>
                                                <select name="classroom_id" class="form-control required" id="select_classroom" required>
                                                    <option  disabled selected>{{__('Select Classroom')}}</option>
                                                   <option value="{{$student->classroom->id}}" selected>{{$student->classroom->name}}</option>                                                                                         
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