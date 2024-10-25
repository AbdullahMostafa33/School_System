@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
         @include('layouts.sidebar')
         @include('components.confirmation-modal', [
         'modalId' => 'restore_model',
         'title' => __('Confirm restore'),
         'message' => __('Are you sure you want to restore the selected students?')
        ])
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Graduated students')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form action="{{route('students.graduates.show')}}" class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">{{__('Search')}}</label>
                                <input type="text" class="form-control" name="search"  placeholder="{{__('Search')}}">
                              </div>                              
                              <div class="form-group col-auto ml-3">  
                                <input type="number"class="custom-select my-1 mr-sm-2" min="2000" name="graduate_year" max="2050" placeholder="{{__('Year')}}">                                                      
                              </div>                              
                            <div class="form-group col-auto ml-3">                                
                                <button class="btn btn-secondary">{{__('Filter')}}</button>
                              </div>
                          </form>
                          </div>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('Action')}} </button>
                            <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                              <button class="dropdown-item" onclick="exportTableToExcel('myTable', 'students_data', [0, 11])">{{__('Export to Excel')}}</button>
                              <button class="dropdown-item" onclick="submit_form_delete()">{{__('Restore Selection')}}</button>
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

                     <form action="{{route('students.restore','restore_selection')}}" method="POST" id="form_delete_selection">
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
                            <th>{{__('National ID')}}</th>
                            <th>{{__('Stage')}}</th>
                            <th>{{__('Grade')}}</th>
                            <th>{{__('Classroom')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th> 
                            <th>{{__('Graduation Year')}}</th> 
                            <th>{{__('Action')}} <form action=""></form></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $i=>$student)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selected-checkbox" id="{{$student->id}}" value="{{$student->id}}" name="students_selected[]" >
                                <label class="custom-control-label" for="{{$student->id}}"></label>
                              </div>
                            </td>
                            <td>{{++$i}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->national_id}}</td>
                            <td>{{$student->classroom->grade->stage->name}}</td>
                            <td>{{$student->classroom->grade->name}}</td>
                            <td>{{$student->classroom->name}}</td>
                            <td>{{$student->address}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td>                                                      
                            <td>{{$student->deleted_at->format('Y')}}</td>  
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">                               
                                <form action="{{route('students.restore',$student->id)}}" method="POST" >
                                  @csrf                                
                                  <button onclick="showConfirmModal(event, 'restore_model','{{$student->name}}')" class="dropdown-item" >
                                    {{__('Restore')}}</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                           @endforeach
                        </tbody>                                                    
                      </table>
                      
                      </form> 
                      {{-- paginate --}}
                      {{ $students->links('components.pagination') }}
                    </div>         
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->         
             

     

      </main> <!-- main -->
    </div> <!-- .wrapper -->
        
        @include('layouts.footer')
<script>
  
  function submit_form_delete(){
    showConfirmModal(event, 'restore_model')
    $(document).on('click', '[id$="ConfirmButton"]', function() {
    $('#form_delete_selection').submit();
    });
  }
  
  </script>  