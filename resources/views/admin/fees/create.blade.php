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
                            <strong>{{__("Add Fees")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('fees.store')}}" method="POST">
                                @csrf                               
                                <div>                                                               
                                    <h3>{{__("Fees information")}}</h3>
                                    <section>
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="name">{{__('Name')}} *</label>
                                                 <input name="name" type="text" class="form-control required" id="name"  >
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label for="address">{{__('Cost')}} *</label>
                                                 <input name="cost" type="number" step="0.01" class="form-control" >
                                             </div>
                                         </div>                                                                         
                                         <div class="form-row">                                           
                                             <div class="form-group col-md-6">
                                                <label for="classroom_id"> {{__('Stage')}} *</label>
                                                <select  class="form-control required" id="select_stage" name="stage_id" required>
                                                    <option  disabled selected>{{__('Select Stage')}}</option>
                                                    <option value='all'>{{__('All Stage')}}</option>
                                                    @foreach($stages as $stage)
                                                         <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="classroom_id">{{__('Grade')}} *</label>
                                                <select  class="form-control required" name="grade_id" id="select_grade" required>
                                                    <option  disabled selected>{{__('Select Grade')}}</option>                                                    
                                                </select>
                                            </div>  
                                            <div class="form-group col-md-6">
                                                 <label for="address">{{__('Year')}}*</label>
                                                 <input name="year" type="number" class="form-control" >
                                             </div>                                                                                                                                 
                                         </div>
                                        <div class="form-row">                                            
                                         <div class="form-group col-md-6">
                                                 <label for="address">{{__('Notes')}}</label>
                                                 <textarea name="notes" class="form-control"></textarea>
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
                x+="<option value='all'>{{__('All Grade')}}</option>"
                grades.forEach(grade => {                  
                 x+="<option value='"+grade.id+"'>"+grade.name+"</option>";
                });
                
                $('#select_grade').empty()
                $('#select_grade').append(x);
              },
            })
        })   
</script>