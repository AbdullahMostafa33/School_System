@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
         @include('layouts.sidebar')
         @include('components.confirmation-modal', [
         'modalId' => 'remove_model',
         'title' => __('Confirm restore'),
         'message' => __('Are you sure you want to remove the selected fees')
        ])
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Academic fees')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('fees.index')}}" class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">{{__('Search')}}</label>
                                <input type="text" class="form-control" name="search"  placeholder="{{__('Search')}}">
                              </div>                              
                              <div class="form-group col-auto ml-3">  
                                <input type="number"class="custom-select my-1 mr-sm-2" min="2000" name="year_filter" max="2050" placeholder="{{__('Year')}}">                                                      
                              </div>                              
                            <div class="form-group col-auto ml-3">                                
                                <button class="btn btn-secondary">{{__('Filter')}}</button>
                              </div>
                          </form>
                          </div>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            <a class="btn btn-primary float-right ml-3"  href="{{route('fees.create')}}">{{__('Add Fees')}} +</a>                            
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('Action')}} </button>
                            <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                              <button class="dropdown-item" onclick="exportTableToExcel('myTable', 'students_data', [0, 8])">{{__('Export to Excel')}}</button>
                              <button class="dropdown-item" onclick="submit_form_delete()">{{__('Delete Selection')}}</button>
                            </div>
                          </div>
                        </div>
                      </div>
                       {{-- show errors       --}}
                      @if ($errors->any())
                       <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                       </div>
                       @endif  
                      <!-- table -->

                     <form action="{{route('fees.delelte.selection')}}" method="POST" id="form_delete_selection">
                        @csrf  
                      <table id="myTable" class="table table-bordered">
                        <thead>
                          <tr role="row">
                            <th>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="all">
                                <label class="custom-control-label" for="all"></label>
                              </div>
                            </th>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Cost')}}</th>
                            <th>{{__('Stage')}}</th>
                            <th>{{__('Grade')}}</th>
                            <th>{{__('Notes')}}</th>
                            <th>{{__('Year')}}</th>                            
                            <th>{{__('Action')}} <form action=""></form></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($fees as $i=>$fee)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selected-checkbox" id="{{$fee->id}}" value="{{$fee->id}}" name="fees_selected[]" >
                                <label class="custom-control-label" for="{{$fee->id}}"></label>
                              </div>
                            </td>
                            <td>{{++$i}}</td>
                            <td>{{$fee->name}}</td>
                            <td>{{$fee->cost}}</td>
                            <td>{{($fee->stage_id)?$fee->stage->name:__('All Stage')}}</td>
                            <td>{{($fee->grade_id)?$fee->grade->name:__('All Grade')}}</td>
                            <td>{{$fee->notes}}</td>
                            <td>{{$fee->year}}</td>                                                                               
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('fees.show',$fee->id)}}"class="dropdown-item" >{{__('show')}}</a>  
                                <a href="{{route('fees.edit',$fee->id)}}"class="dropdown-item" >{{__('Edit')}}</a>                               
                                <form action="{{route('fees.destroy',$fee->id)}}" method="POST" >
                                  @csrf    
                                  @method('DELETE')                            
                                  <button onclick="showConfirmModal(event, 'remove_model','{{$fee->name}}')" class="dropdown-item" style="color: red" >
                                    {{__('Remove')}}</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                           @endforeach
                        </tbody>                                                    
                      </table>
                      
                      </form> 
                      
                    </div>         
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->         
             

     

      </main> <!-- main -->
    </div> <!-- .wrapper -->
        
        @include('layouts.footer')
<script>
  
  function submit_form_delete(){
    showConfirmModal(event, 'remove_model')
    $(document).on('click', '[id$="ConfirmButton"]', function() {
    $('#form_delete_selection').submit();
    });
  }
  
  </script>  