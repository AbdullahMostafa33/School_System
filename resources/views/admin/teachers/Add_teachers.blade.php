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
                            <strong>{{__("Add Teacher")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('teachers.store')}}" method="POST">
                                @csrf                               
                                <div>
                                    <!-- Teacher Account Section -->
                                    <h3>Teacher Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label> {{__('Teacher Email')}} *</label>
                                            <input  name="email" type="text" class="form-control required" >
                                        </div>
                                        <div class="form-group">
                                            <label for="password">{{__('Password')}} *</label>
                                            <input id="password" name="password" type="password" class="form-control required">
                                        </div>                                                                             
                                    </section>

                                    <!-- Teacher Profile Section -->
                                    <h3>Teacher Profile</h3>
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
                                                 <label for="nationality_id">Nationality *</label>
                                                 <select name="nationality_id" class="form-control required" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->id }}" >{{ $nationality->name }}</option>
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
                                            <label for="date-input1">Date Join *</label>
                                            <div class="input-group">
                                              <input type="date" class="form-control required" name="join_at"  aria-describedby="button-addon2" required>                                              
                                            </div>
                                          </div>                                             
                                         </div> 
                                         <div class="form-row">
                                            <label for="example-multiselect">{{__("Select Specialty")}}</label>
                                            <select id="example-multiselect" name="specialty[]" class="form-control"multiple>
                                                     @foreach($specialties as $specialty)
                                                         <option value="{{ $specialty->id }}" >{{ $specialty->name }}</option>
                                                     @endforeach
                                            </select>
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