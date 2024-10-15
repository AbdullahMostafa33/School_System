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
                            <strong>{{__("Show Parent Information")}}</strong>
                        </div>
                        <div class="card-body">
                            <form id="parent-form">
                                @csrf
                                @method('PUT')
                                <div>
                                    <!-- Parent Account Section -->
                                    <h3>Parent Account</h3>
                                    <section>
                                        <div class="form-group">
                                            <label>{{__('Parent Email')}} *</label>
                                            <input type="text" class="form-control required" value="{{$parent->email}}" readonly>
                                        </div>                                                                           
                                    </section>

                                    <!-- Parent Profile Section -->
                                    <h3>Parent Profile</h3>
                                    <section>
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label>Name *</label>
                                                 <input type="text" class="form-control required" value="{{$parent->name}}" readonly>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label>Address</label>
                                                 <input type="text" class="form-control" value="{{$parent->address}}" readonly>
                                             </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label>Phone *</label>
                                                 <input type="text" class="form-control required" value="{{$parent->phone}}" readonly>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label>Religion</label>
                                                 <select class="form-control" disabled>
                                                     <option disabled selected>Select Religion</option>
                                                     <option value="1" {{$parent->religion==1?'selected':''}}>Muslim</option>
                                                     <option value="2" {{$parent->religion==2?'selected':''}}>Christian</option>                                                     
                                                 </select>
                                             </div>
                                         </div>                                     
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label>Nationality *</label>
                                                 <select class="form-control required" disabled>
                                                     <option disabled selected>Select Nationality</option>
                                                     @foreach($nationalities as $nationality)
                                                         <option value="{{ $nationality->id }}" {{$nationality->id==$parent->nationality_id?'selected':''}}>{{ $nationality->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label>National ID *</label>
                                                 <input type="text" class="form-control required" value="{{$parent->national_id}}" readonly>
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
