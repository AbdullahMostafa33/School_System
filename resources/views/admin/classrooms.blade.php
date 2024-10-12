@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Academic Classrooms')}}</h2>
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
                              <a class="dropdown-item" href="#">Export</a>
                              <a class="dropdown-item" href="#">Delete</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered">
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
                            <th>{{__('Grade')}}</th>
                            <th>{{__('Stage')}}</th>
                            <th>{{__('Status')}}</th>  
                            <th>{{__('Action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($classrooms as $i=>$classroom)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="4574">
                                <label class="custom-control-label" for="4574"></label>
                              </div>
                            </td>
                            <td>{{++$i}}</td>
                            <td>{{$classroom->name}}</td>
                            <td>{{$classroom->grade->name}}</td>
                            <td>{{$classroom->grade->statge->name}}</td>
                            @if ($classroom->status)
                               <td><span class="badge badge-pill badge-success">{{__("Active")}}</span></td>
                            @else
                                <td><span class="badge badge-pill badge-danger">{{__("Inactive")}}</span></td>
                            @endif
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">{{__('Action')}}</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item edit_btn"   type="button" data-name="{{$classroom->name}}" data-status="{{$classroom->status}}" data-statge_id="{{$classroom->grade->statge->id}}" data-grade_id="{{$classroom->grade_id}}" data-url="{{route('classrooms.update',$classroom->id)}}">{{__('Edit')}}</button>
                                <form action="{{route('classrooms.destroy',$classroom->id)}}" method="POST">
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
                      <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-end mb-0">
                          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                      </nav>
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
                    <strong id="title_form" class="card-title">{{__('Add classroom')}}</strong>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('classrooms.store')}}" id="form_manage">
                      @csrf
                     
                      <div class="form-row">
                        <div class="form-group ">
                          <label>{{__('Name')}}</label>
                          <input type="text" class="form-control" name="name" id="name_input" placeholder="{{__('Enter Name')}}">
                        </div> 
                        <div class="form-group col-md-6">
                          <label for="simple-select2">{{__('Status')}}</label>
                          <select class="form-control " id="status_input" name="status">
                            <option value="null option" disabled selected>{{__('Select Status')}}</option>                                                     
                               <option value="1">{{__('Activie')}}</option>
                               <option value="0">{{__('Inactive')}}</option>                                                                              
                          </select>
                        </div> <!-- form-group -->
                        <div class="form-group col-md-6">
                          <label>{{__('Stage')}}</label>
                          <select class="form-control " id="select_stage" >
                            <option value="null option" disabled selected>{{__('Select Stage')}}</option>
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
               $('#select_stage').val($(this).data('statge_id'))
               getgrades($(this).data('statge_id'))
               $('#select_grade').val($(this).data('grade_id'))
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
              data:{statge_id:select_value},
              success:function(grades){
                var x=""
                grades.forEach(grade => {                  
                 x+="<option value='"+grade.id+"'>"+grade.name+"</option>";
                });
                
                $('#select_grade').empty()
                $('#select_grade').append(x);
              },
            })
              }               
            
</script>

        @include('layouts.footer')
   