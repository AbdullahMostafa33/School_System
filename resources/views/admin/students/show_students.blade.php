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
                            <strong>{{__("Show Student Information")}}</strong>
                        </div>
                        <div class="card-body">
                            <form>                               
                                <div>
                                    <!-- Student Account Section -->
                                    <h3>Student Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label>{{__('Student Email')}} *</label>
                                            <input name="email" type="text" class="form-control required" value="{{$student->email}}" readonly>
                                        </div>                                                                                                                  
                                    </section>

                                    <!-- Student Profile Section -->
                                    <h3>Student Profile</h3>
                                    <section>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Name *</label>
                                                <input name="name" type="text" class="form-control required" id="name" value="{{$student->name}}" readonly required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="address">Address</label>
                                                <input name="address" type="text" class="form-control" value="{{$student->address}}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="phone">Phone *</label>
                                                <input name="phone" type="text" class="form-control required" value="{{$student->phone}}" readonly required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="religion">Religion</label>
                                                <select name="religion" class="form-control" id="religion" disabled>
                                                    <option disabled selected>{{__('Select Religion')}}</option>
                                                    <option value="1" {{$student->religion==1?'selected':''}}>Muslim</option>
                                                    <option value="2" {{$student->religion==2?'selected':''}}>Christian</option>                                                     
                                                </select>
                                            </div>
                                        </div>                                     
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nationality">Nationality *</label>
                                                <select name="nationality" class="form-control required" required disabled>
                                                    <option  selected>{{$student->nationality}}</option>                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="national_id">National ID *</label>
                                                <input name="national_id" type="text" class="form-control required" value="{{$student->national_id}}" readonly required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender</label>
                                                <select name="gender" class="form-control" disabled>
                                                    <option disabled selected>{{__('Select Gender')}}</option>
                                                    <option value="0" {{$student->gender==0?'selected':''}}>Male</option>
                                                    <option value="1" {{$student->gender==1?'selected':''}}>Female</option>                                                     
                                                </select>
                                            </div> 
                                            <div class="form-group col-md-6">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <select  class="form-control required" id="select_stage" disabled>
                                                    <option  selected>{{$student->classroom->grade->stage->name}}</option>
                                                   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Grade')}} *</label>
                                                <select  class="form-control required" id="select_grade" disabled>
                                                    <option  selected>{{$student->classroom->grade->name}}</option>                                                    
                                                </select>
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Classroom')}} *</label>
                                                <select name="classroom_id" class="form-control required" id="select_classroom" disabled>
                                                    <option  selected>{{$student->classroom->name}}</option>
                                                    
                                                </select>
                                            </div>                                                                                    
                                        </div>                                        
                                       
                                        <div class="help-text text-muted">(*) Mandatory fields 
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
