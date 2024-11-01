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
                            <strong>{{__("Show Online Class")}}</strong>
                        </div>
                        <div class="card-body">
                                <div>                                 
                                    <h3>{{__("Online Class information")}}</h3>
                                    <section>
                                         <div class="form-row">
                                             <div class="form-group col-md-3">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <input type="text" class="form-control required"  value="{{$onlineClass->grade->stage->name}}" readonly>                                                
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="classroom_id">{{__('Grade')}} *</label>                                                
                                                <input type="text" class="form-control required"  value="{{$onlineClass->grade->name}}" readonly>                                                
                                            </div>
                                             <div class="form-group col-md-3">
                                                <label for="classroom_id">{{__('Classroom')}} *</label>
                                                <input type="text" class="form-control required"  value="{{$onlineClass->classroom->name}}" readonly>                                                
                                            </div> 
                                             <div class="form-group col-md-3">
                                                <label for="specialty_id">{{__('Specilaty')}} *</label>
                                                <input type="text" class="form-control required"  value="{{$onlineClass->specialty->name}}" readonly>                                                                                 
                                            </div> 
                                         </div>   
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">{{__("Name")}} *</label>
                                                 <input type="text" class="form-control required" value="{{$onlineClass->name}}" readonly>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="title">{{__("Title")}} *</label>
                                                 <input  type="text" class="form-control" value="{{$onlineClass->title}}" readonly>
                                             </div>
                                         </div>                                                                          
                                         <div class="form-row">                                            
                                             <div class="form-group col-md-6">
                                                 <label for="duration">{{__("Duration in minutes")}} *</label>
                                                 <input  type="number" class="form-control required" value="{{$onlineClass->duration}}" readonly>
                                             </div>
                                             
                                             <div class="col-md-6 mb-3">
                                            <label for="date-input1">{{__("Start Date")}} *</label>
                                            <div class="input-group">
                                              <input type="datetime-local" class="form-control required" value="{{$onlineClass->start_at}}" aria-describedby="button-addon2" readonly>                                              
                                            </div> 
                                          </div>                                             
                                         </div>                                                                            
                                       
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="join_url">{{__("Host Link")}} : </label>
                                                <a href="{{$onlineClass->start_url}}" target="_blank">{{__("Host Link")}}</a>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="join_url">{{__("Join Link")}} : </label>
                                                <a href="{{$onlineClass->join_url}}" target="_blank">{{__("Join Link")}}</a>
                                            </div>
                                        </div>
                                    </section>                                 
                                </div>
                        
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
</div> <!-- .wrapper -->
@include('layouts.footer')
