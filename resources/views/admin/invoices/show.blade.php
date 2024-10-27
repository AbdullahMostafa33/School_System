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
                            <strong>{{__("Add Student")}}</strong>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('invoices.store')}}" method="POST">
                                @csrf 
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
                                        @foreach ($invoice->fees as $fee)                                           
                                        
                                        <div  class="fee-model"> 
                                            <div class="form-row" id="model_add">
                                                <div class="form-group col-md-3">
                                                    <label for="classroom_id">{{__('Type Fees')}} </label>
                                                    <input  type="text" value="{{$fee->name}}" class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="name">Cost </label>
                                                    <input  type="text" value="{{$fee->cost}}" class="form-control" readonly>
                                                </div>  
                                                <div class="form-group col-md-3">
                                                    <label for="Notes">Notes</label>
                                                    <input type="text" value="{{ $fee->pivot->notes }}"  class="form-control" readonly>
                                                </div>                                                                             
                                            </div>
                                        </div>

                                        @endforeach

                                           <div class="form-row" id="model_add">
                                                <div class="form-group col-md-3">
                                                    <label for="classroom_id">{{__('Total amount')}} </label>
                                                    <input  type="text" value="{{$invoice->amount}}" class="form-control" readonly>
                                                </div>                                                                                                                                         
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="name">{{__("Status")}} </label>
                                                    <input  type="text" value="{{$invoice->status?'Paid':'Unpaid'}}" class="form-control" readonly>
                                                </div> 
                                                <div class="form-group col-md-3">                                                   
                                                    @if ($invoice->paid_at)
                                                        <label for="name">{{__("Paid at")}} </label>
                                                        <input  type="text" value="{{$invoice->paid_at}}" class="form-control" readonly>
                                                    @endif
                                                </div> 
                                            </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                                    <label for="Notes">Notes</label>
                                                    <textarea  class="form-control" readonly>{{$invoice->notes}}</textarea>
                                                </div>
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

