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
                            <strong>{{__("Create Invoice")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('invoices.update',$invoice->id)}}" method="POST">
                                @csrf 
                                @method('PUT')
                                <div>
                                    <!-- Student Account Section -->
                                    <center><h3>Student infromation</h3></center><br>
                                    <section>
                                        <div class="form-row">
                                        <div class="form-group col-md-4">
                                                 <label for="name">Name </label>
                                                 <input type="text" value="{{$student->name}}" class="form-control required" readonly>
                                             </div>
                                        <div class="form-group col-md-4">
                                                 <label for="name">Stage </label>
                                                 <input type="text" value="{{$student->classroom->grade->stage->name}}" class="form-control required" readonly>
                                             </div> 
                                              <div class="form-group col-md-4">
                                                 <label for="name">Grade </label>
                                                 <input type="text" value="{{$student->classroom->grade->name}}" class="form-control required" readonly>
                                             </div> 
                                          </div>                                                                             
                                    </section>

                                    <!-- Student Profile Section -->
                                    <h3> {{__('Invoice Detail')}}</h3>
                                    <section>
                                        {{-- model --}}
                                        <div  class="fee-model">
                                            @foreach ($invoice->fees as $invoice_fee)                                                                                            
                                            <div class="form-row" id="model_add">
                                                <div class="form-group col-md-3">
                                                    <label for="classroom_id">{{__('Type Fees')}} *</label>
                                                    <select class="form-control select_fees" name="fees[]">
                                                        <option disabled selected>{{__('Select Type')}}</option>
                                                        @foreach ($fees as $fee)
                                                            <option id="{{$fee->id}}" value="{{$fee->id}}" data-cost="{{$fee->cost}}"
                                                                {{$invoice_fee->id==$fee->id?'selected':''}}
                                                                >{{$fee->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="name">Cost *</label>
                                                    <input name="costs[]" type="text" value="{{$invoice_fee->cost}}" class="form-control cost" readonly> <!-- Use array notation for multiple costs -->
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="Notes">Notes</label>
                                                    <input name="notes[]" type="text" value="{{ $invoice_fee->pivot->notes }}"  class="form-control">
                                                </div>
                                                <div class="form-group col-md-3" id="btn_del">
                                                     <label>_</label>
                                                     <input name="" type="button" value="{{__('Delete')}}" class="form-control delete_btn" style="color: red" >
                                                 </div> 
                                            </div>
                                            @endforeach 
                                        </div>
                                         {{-- add here --}}
                                         <div id="add"></div>                                                                                                                                                               
                                          <button class="btn btn-primary float ml-3" id="add_more">{{__('Add more')}}</button>  

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
                                  <center><button class="btn btn-primary float ml-3" name="student_id" value="{{$student->id}}">
                                    {{__('Update')}}</button></center>
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
    // When the select fee is changed
    $(document).on('change', '.select_fees', function() {
        var cost = $(this).find('option:selected').data('cost');
        $(this).closest('.form-row').find('.cost').val(cost); // Only update cost in the same fee-model
    });

    // When the "Add more" button is clicked
    $('#add_more').on('click', function(event) {
        event.preventDefault();
        $('#add').append(`
        <div class="form-row">
           <div class="form-group col-md-3">
               <label for="classroom_id">{{__('Type Fees')}} *</label>
               <select class="form-control select_fees" name="fees[]">
                   <option disabled selected>{{__('Select Type')}}</option>
                   @foreach ($fees as $fee)
                       <option id="{{$fee->id}}" value="{{$fee->id}}" data-cost="{{$fee->cost}}">{{$fee->name}}</option>
                   @endforeach
               </select>
           </div>
           <div class="form-group col-md-3">
               <label for="name">Cost *</label>
               <input name="costs[]" type="text" class="form-control cost" readonly> <!-- Use array notation for multiple costs -->
           </div>
           <div class="form-group col-md-3">
               <label for="Notes">Notes</label>
               <input name="notes[]" type="text"  class="form-control">
           </div>
           <div class="form-group col-md-3">
                <label>_</label>
                <input name="" type="button" value="{{__('Delete')}}" class="form-control delete_btn" style="color: red" >
            </div> 
       </div>`);
        
    });
    $('#btn_del').hide() //hide first btn_del
    // When the delete button is clicked
    $(document).on('click', '.delete_btn', function() {
        $(this).closest('.form-row').remove(); 
    });
</script>
