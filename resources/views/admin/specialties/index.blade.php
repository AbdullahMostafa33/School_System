@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
         @include('components.confirmation-modal', [
         'modalId' => 'remove_model',
         'title' => __('Confirm Delete'),
         'message' => __('Are you sure you want to remove the selected specialties')
        ])
    
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Academic Specialties')}}</h2>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline">
                            <form action="{{route('classrooms.index')}}">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">{{__('Search')}}</label>
                                <input type="text" class="form-control" name="search" placeholder="{{__('Search')}}">
                              </div>
                              <div class="form-group col-auto ml-3">
                                <label class="my-1 mr-2 sr-only" for="inlineFormCustomSelectPref">Status</label>                               
                                <select class="custom-select my-1 mr-sm-2" name="filter">                                                                                                                              ">
                                  <option disabled selected>{{__('Filter Stage')}}</option>
                                  @foreach ($stages as $stage)
                                    <option value="{{$stage->id}}">{{$stage->name}}</option>
                                  @endforeach
                                </select>
                                <button class="btn btn-secondary">{{__('Filter')}}</button>
                                </form>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            <button class="btn btn-primary float-right ml-3" type="button" id="addWidgetBtn">{{__('Add more')}} +</button>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('Action')}} </button>
                            <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                              <button class="dropdown-item" onclick="exportTableToExcel('myTable', 'students_data', [0, 5])">{{__('Export to Excel')}}</button>
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
                         <form action="{{route('specialties.delete.selection')}}" id="form_delete_selection" method="POST">
                          @Csrf
                          @method('DELETE')
                      <table class="table table-bordered" id="myTable">
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
                            <th>{{__('Stage')}}</th> 
                            <th>{{__('Grade')}}</th>                          
                            <th>{{__('Action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($specialties as $i=>$specialty)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selected-checkbox" id="{{$specialty->id}}" value="{{$specialty->id}}" name="specialties_selected[]" >
                                <label class="custom-control-label" for="{{$specialty->id}}"></label>
                              </div>
                            </td>
                            <td>{{++$i}}</td>
                            <td>{{$specialty->name}}</td>
                            <td>{{$specialty->stage_id ? $specialty->stage->name : __('All stages')}}</td>
                            <td>{{$specialty->grade_id ? $specialty->grade->name : __('All grades')}}</td>                              
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item edit_btn"   type="button" data-name="{{$specialty->name}}" data-status="{{$specialty->status}}" data-stage_id="{{$specialty->stage_id ?$specialty->stage_id:null}}" data-grade_id="{{$specialty->grade_id ?$specialty->grade_id:null}}" data-url="{{route('specialties.update',$specialty->id)}}">{{__('Edit')}}</button>
                                <form action="{{route('specialties.destroy',$specialty->id)}}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <button class="dropdown-item"  style="color: red">{{__('Remove')}}</button>
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
          
              <!-- add classroom -->
              <div id="Overlay_add" class="overlay">
        <div class="widget">
            <h3>{{__("Enter Information")}}</h3>
           
                 <div class="card shadow mb-4">
                  <div class="card-header">
                    <strong id="title_form" class="card-title">{{__('Add Specialty')}}</strong>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('specialties.store')}}" id="form_manage">
                      @csrf
                     
                      <div class="form-row">
                        <div class="form-group ">
                          <label>{{__('Name')}}</label>
                          <input type="text" class="form-control" name="name" id="name_input" placeholder="{{__('Enter Name')}}">
                        </div> 
                        <div class="form-group col-md-6">                          
                        </div> <!-- form-group -->
                        <div class="form-group col-md-6">
                          <label>{{__('Stage')}}</label>
                          <select class="form-control " id="select_stage" name="stage_id" >
                            <option value="null option" disabled selected>{{__('Select Stage')}}</option>
                            <option value="all">{{__('All stages')}}</option>
                              @foreach ($stages as $stage)
                               <option value="{{$stage->id}}">{{$stage->name}}</option>
                              @endforeach  
                          </select>
                        </div> <!-- form-group -->
                        <div class="form-group col-md-6">
                          <label >{{__('Grade')}}</label>
                          <select class="form-control" id="select_grade" name="grade_id">
                              <option value="null option" disabled selected>{{__('Select Grade')}}</option>                                                       
                          </select>
                        </div> <!-- form-group -->
                      <div class="form-group ">                                             
                      </div>                              
                      </div>                      
                      <button type="submit" id="btn_form" class="btn btn-primary">{{__('Submit')}}</button>
                      <span  id="close_btn_add" class="btn btn-primary" style="background-color: grey">{{__('Close')}}</span>
                    </form>                   
                  </div>
                </div>
        </div>
    </div>

      </main> <!-- main -->
    </div> <!-- .wrapper -->
         <script>
          //click add more
          $('#addWidgetBtn').click(function(){
             $('#Overlay_add').css('display','block')
          })

          //click edit
          $('.edit_btn').click(function(){
               $('#Overlay_add').css('display','block')
               $('#name_input').val($(this).data('name'))
               $('#status_input').val($(this).data('status'))
               stage=$(this).data('stage_id')
               stage==''? stage='all' : stage=stage
               $('#select_stage').val(stage)
               getgrades(stage)
               grade=$(this).data('grade_id')
               grade==null ? grade='all' : grade=grade
               $('#select_grade').val(grade)
               $('#form_manage').attr('action', $(this).data('url')); 
              $('#form_manage').append('<input id="method_put" type="hidden" name="_method" value="PUT">');
              $('#btn_form').text('{{__('Update')}}')
              $('#title_form').text("{{__('Update classroom')}}")                       
            })
            //close 
             $('#close_btn_add').click(function(){
               $('#Overlay_add ').css('display','none') 
               // return default add content
               $('#name_input').val('')  
               $('#status_input').val('null option')  
               $('#select_stage').val('null option')
               $('#select_grade').val('null option') 
               $('#form_manage').attr('action', '{{route('classrooms.store')}}') 
               $('#method_put').remove();
               $('#btn_form').text('{{__('Submit')}}')
               $('#title_form').text('{{__('Add classroom')}}')

            })

   //// get grade when select stage
            $('#select_stage').on('change',function(){
             var select_value=$(this).val()
             getgrades(select_value)
          })


          // get grade and put it in select grade
          function getgrades(select_value){            
                $.ajax({
              url:"{{route('grades.get')}}",
              type:'GET',
              data:{stage_id:select_value},
              success:function(grades){
                var x=""
                x+=`<option value="all">{{__('All Grades')}}</option>`
                grades.forEach(grade => {                  
                 x+="<option value='"+grade.id+"'>"+grade.name+"</option>";
                });
                
                $('#select_grade').empty()
                $('#select_grade').append(x);
              },
            })
              }   
              
  function submit_form_delete(){
    showConfirmModal(event, 'remove_model')
    $(document).on('click', '[id$="ConfirmButton"]', function() {
    $('#form_delete_selection').submit();
    });
  }
  
            
</script>

        @include('layouts.footer')
   