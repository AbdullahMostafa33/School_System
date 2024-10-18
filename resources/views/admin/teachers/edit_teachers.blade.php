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
                            <strong>{{__("Edit Teacher Information")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('teachers.update',$teacher->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div>
                                    <!-- Teacher Account Section -->
                                    <h3>Teacher Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label> {{__('Teacher Email')}} *</label>
                                            <input  name="email" type="text" class="form-control required" value="{{$teacher->email}}">
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
                                                 <input name="name" type="text" class="form-control required" id="name" value="{{$teacher->name}}" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">Address</label>
                                                 <input name="address" type="text" class="form-control" value="{{$teacher->address}}">
                                             </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="phone">Phone *</label>
                                                 <input name="phone" type="text" class="form-control required" value="{{$teacher->phone}}" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="religion">Religion</label>
                                                 <select name="religion" class="form-control" id="religion">
                                                     <option  disabled selected>{{__('Select Religion')}}</option>
                                                     <option value="1" {{$teacher->religion==1?'selected':''}}>Muslim</option>
                                                     <option value="2" {{$teacher->religion==2?'selected':''}}>Christian</option>                                                     
                                                 </select>
                                             </div>
                                         </div>                                     
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="nationality">Nationality *</label>
                                                 <select name="nationality" class="form-control required" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->name }}" {{$nationality->name==$teacher->nationality?'selected':''}}>{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="national_id">National ID *</label>
                                                 <input name="national_id" type="text" class="form-control required" value="{{$teacher->national_id}}" required>
                                             </div>
                                               <div class="form-group col-md-6">
                                                 <label for="religion">Gender</label>
                                                 <select name="gender" class="form-control" >
                                                     <option  disabled selected>{{__('Select Gender')}}</option>
                                                     <option value="0" {{$teacher->gender==0?'selected':''}}>Male</option>
                                                     <option value="1" {{$teacher->gender==1?'selected':''}}>Female</option>                                                     
                                                 </select>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                            <label for="date-input1">Date Join *</label>
                                            <div class="input-group">
                                                    <input type="date" class="form-control required"name="join_at" value="{{$teacher->join_at->format('Y-m-d')}}" aria-describedby="button-addon2"  required>                                    
                                              <div class="input-group-append">
                                                <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16 mx-2"></span></div>
                                              </div>
                                            </div>
                                          </div>                                             
                                         </div> 
                                         <div class="form-row">
                                        <label for="example-multiselect">{{__("Select Specialty")}}</label>
                                        <select id="example-multiselect" name="specialty[]" class="form-control"multiple>
                                                 @foreach($specialties as $specialty)
                                                     <option value="{{ $specialty->id }}" {{in_array($specialty->id, $teacher_specialty)?'selected':''}}>{{ $specialty->name }}</option>
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