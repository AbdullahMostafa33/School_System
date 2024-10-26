@include('layouts.header')
<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card my-4">                        
                        <div class="card-body">
                            <form  action="{{route('fees.store')}}" method="POST">
                                @csrf                               
                                <div>                                                               
                                    <h3>{{__("Fees information")}}</h3>
                                    <section>
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">{{__('Name')}} *</label>
                                                 <input value="{{$fee->name}}" type="text" class="form-control required" id="name"  readonly>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">{{__('Cost')}} *</label>
                                                 <input value="{{$fee->cost}}"type="number" step="0.01" class="form-control" readonly>
                                             </div>
                                         </div>                                                                         
                                         <div class="form-row">                                           
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                 <input value="{{($fee->stage_id)?$fee->stage->name:__('All Stage')}}"type="text" step="0.01" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Grade')}} *</label>
                                                 <input value="{{($fee->grade_id)?$fee->grade->name:__('All Grade')}}"type="text" step="0.01" class="form-control" readonly>                                                
                                            </div>  
                                            <div class="form-group col-md-6">
                                                 <label for="address">{{__('Year')}}*</label>
                                                 <input value="{{$fee->cost}}" type="number" class="form-control"readonly >
                                             </div>                                                                                                                                 
                                         </div>
                                        <div class="form-row">                                            
                                         <div class="form-group col-md-6">
                                                 <label for="address">{{__('Notes')}}</label>
                                                 <textarea name="notes" class="form-control" readonly>{{$fee->notes}}</textarea>
                                             </div> 
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
