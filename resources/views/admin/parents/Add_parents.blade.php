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
                            <strong>Add Parent Information</strong>
                        </div>
                        <div class="card-body">
                            <form id="parent-form" action="{{route('parents.store')}}" method="POST">
                                @csrf
                                <div>
                                    <!-- Parent Account Section -->
                                    <h3>Parent Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="parent_username">{{__('Parent Email')}} *</label>
                                            <input id="parent_username" name="parent_email" type="text" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_password">{{__('Password')}} *</label>
                                            <input id="parent_password" name="parent_password" type="password" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_confirm_password">{{__('Confirm Password')}} *</label>
                                            <input id="parent_confirm_password" name="parent_confirm_password" type="password" class="form-control required">
                                        </div>
                                        <div class="help-text text-muted" >(*) Mandatory fields <div class="error_show"></div></div>
                                    </section>

                                    <!-- Parent Profile Section -->
                                    <h3>Parent Profile</h3>
                                    <section>
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">Name *</label>
                                                 <input name="name_parent" type="text" class="form-control required" id="name" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">Address</label>
                                                 <input name="address_parent" type="text" class="form-control" id="address">
                                             </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="phone">Phone *</label>
                                                 <input name="phone_parent" type="text" class="form-control required" id="phone" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="religion">Religion</label>
                                                 <select name="religion_parent" class="form-control" id="religion">
                                                     <option  disabled selected>Select Religion</option>
                                                     <option value="1">Muslim</option>
                                                     <option value="2">Christian</option>                                                     
                                                 </select>
                                             </div>
                                         </div>
                                     
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="nationality_id">Nationality *</label>
                                                 <select name="nationality_id_parent" class="form-control required" id="nationality_id" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="national_id">National ID *</label>
                                                 <input name="national_id_parent" type="text" class="form-control required" id="national_id" required>
                                             </div>
                                         </div>    
                                        <div class="help-text text-muted" >(*) Mandatory fields <div class="error_show"> </div></div>
                                    </section>

                                    <!-- Student Information Section -->
                                    <h3>Student Information</h3>
                                    <section>
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">{{__("Student Email")}} *</label>
                                                <input name="email_student" type="email" class="form-control required" id="email" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">{{__("Student Name")}} *</label>
                                                <input name="name_student" type="text" class="form-control required" id="name" required>
                                            </div>
                                        </div>
                                    
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="national_id">{{__('National ID')}} *</label>
                                                <input name="national_id_student" type="text" class="form-control required" id="national_id" required>
                                            </div> 
                                             <div class="form-group col-md-6">
                                                 <label for="address">Address</label>
                                                 <input name="address_student" type="text" class="form-control" id="address">
                                             </div>                                        
                                        </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-6">
                                                 <label for="phone">Phone *</label>
                                                 <input name="phone_student" type="text" class="form-control required" id="phone" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="nationality_id">Nationality *</label>
                                                 <select name="nationality_id_student" class="form-control required" id="nationality_id" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="religion">Religion</label>
                                                 <select name="religion_student" class="form-control" id="religion">
                                                     <option  disabled selected>Select Religion</option>
                                                     <option value="1">Muslim</option>
                                                     <option value="2">Christian</option>
                                                     
                                                 </select>
                                             </div>
                                         </div>
                                        <div class="form-row">
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
                                     <div class="help-text text-muted" >(*) Mandatory fields <div class="error_show"> </div></div>                                                                     
                                    </section>

                                    <!-- Finish Section -->
                                    <h3>Finish</h3>
                                    <section>
                                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> 
                                        <label for="acceptTerms">I agree with the Terms and Conditions.</label>                                        
                                    </section>
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
        
    
<!-- Scripts for Form Wizard -->
<script>
    // Form validation and wizard initialization
    var form = $("#parent-form");
    if (form.length) {
        form.validate({
            errorPlacement: function (e, a) {
                a.before(e);
            },
            rules: {
                parent_confirm_password: {
                    equalTo: "#parent_password"
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (e, a, o) { 
                form.validate().settings.ignore = ":disabled,:hidden";

                // Check form validity first and prevent moving to the next step if invalid
                if (!form.valid()) {
                    return false;
                }

                // If the form is valid, proceed to check the current step with the server
                var formData = form.serialize(); // Get form data
                var currentStep = a; 
                formData += "&current_step=" + currentStep;

                console.log("success: " + formData); // Log success message
                
                var move = false; // Default to false, preventing movement by default
                
                // Perform AJAX request (asynchronously)
                $.ajax({
                    url: "{{ route('parents.validate_step') }}",
                    type: 'POST',
                    data: formData,
                    async: false, // Force the AJAX call to be synchronous
                    success: function(response) {                                     
                        if(!response.success){ //show error of response=false
                            $('.error_show').empty()
                             response.errors.forEach(error => {                                
                            var erHTML='<div class="alert alert-danger"><ul><li>'+error+'</li></ul></div>'
                             $('.error_show').append(erHTML)
                        });
                        }    else $('.error_show').empty()                 
                        move = response.success; // Set move to true or false based on the response
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });         
                // Only move to the next step if the response is successful (move = true)
                return move;
            },
            onFinishing: function (e, a) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (e, a) {
                form.submit();
            }
        });        
    }

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

