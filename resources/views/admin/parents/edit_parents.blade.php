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
                            <strong>{{__("Edit Parent Information")}}</strong>
                        </div>
                        <div class="card-body">
                            <form id="parent-form" action="{{route('parents.update',$parent->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div>
                                    <!-- Parent Account Section -->
                                    <h3>Parent Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="parent_username">{{__('Parent Email')}} *</label>
                                            <input id="parent_username" name="parent_email" type="text" class="form-control required" value="{{$parent->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_password">{{__('Password')}} *</label>
                                            <input id="parent_password" name="parent_password" type="password" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_confirm_password">{{__('Confirm Password')}} *</label>
                                            <input id="parent_confirm_password" name="parent_confirm_password" type="password" class="form-control required">
                                        </div>                                        
                                    </section>

                                    <!-- Parent Profile Section -->
                                    <h3>Parent Profile</h3>
                                    <section>
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">Name *</label>
                                                 <input name="name_parent" type="text" class="form-control required" id="name" value="{{$parent->name}}" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">Address</label>
                                                 <input name="address_parent" type="text" class="form-control" value="{{$parent->address}}">
                                             </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="phone">Phone *</label>
                                                 <input name="phone_parent" type="text" class="form-control required" value="{{$parent->phone}}" required>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="religion">Religion</label>
                                                 <select name="religion_parent" class="form-control" id="religion">
                                                     <option  disabled selected>Select Religion</option>
                                                     <option value="1" {{$parent->religion==1?'selected':''}}>Muslim</option>
                                                     <option value="2" {{$parent->religion==2?'selected':''}}>Christian</option>                                                     
                                                 </select>
                                             </div>
                                         </div>                                     
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="nationality_id">Nationality *</label>
                                                 <select name="nationality_id_parent" class="form-control required" required>
                                                     <option  disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->id }}" {{$nationality->id==$parent->nationality_id?'selected':''}}>{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="national_id">National ID *</label>
                                                 <input name="national_id_parent" type="text" class="form-control required" value="{{$parent->national_id}}" required>
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
        
    


