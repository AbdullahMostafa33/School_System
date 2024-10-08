@include('layouts.header')
    <div class="wrapper">
     
        @include('layouts.navbar')
        @include('layouts.sidebar')
    
      <main role="main" class="main-content">
        <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">{{__('Academic stages')}}</h2>
                  <p class="mb-4">Customized table based on Bootstrap with additional elements and more functions</p>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline">
                            <div class="form-row">
                              <div class="form-group col-auto">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" class="form-control" id="search" value="" placeholder="Search">
                              </div>
                              <div class="form-group col-auto ml-3">
                                <label class="my-1 mr-2 sr-only" for="inlineFormCustomSelectPref">Status</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                  <option selected>Choose...</option>
                                  <option value="1">Processing</option>
                                  <option value="2">Success</option>
                                  <option value="3">Pending</option>
                                  <option value="3">Hold</option>
                                </select>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            <button class="btn btn-primary float-right ml-3" type="button" id="addWidgetBtn">Add more +</button>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Notice</th>  
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($statges as $statge)                                                     
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="4574">
                                <label class="custom-control-label" for="4574"></label>
                              </div>
                            </td>
                            <td>{{$statge->id}}</td>
                            <td>{{$statge->name}}</td>
                            <td>{{$statge->notice}}</td>                            
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">Action</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item edit_btn"   type="button" data-name="{{$statge->name}}" data-notice="{{$statge->notice}}" data-url="{{route('statge.update',$statge->id)}}">Edit</button>
                                <form action="{{route('statge.destroy',$statge->id)}}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <button class="dropdown-item"  style="color: red">Remove</button>
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
          
              <!-- add statge -->
              <div id="Overlay_add" class="overlay">
        <div class="widget">
            <h3>Enter Information</h3>
           
                 <div class="card shadow mb-4">
                  <div class="card-header">
                    <strong  class="card-title">{{__('Add statge')}}</strong>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('statge.store')}}" id="form1">
                      @csrf
                     
                      <div class="form-row">
                        <div class="form-group ">
                          <label>{{__('Name')}}</label>
                          <input type="text" class="form-control" name="name" >
                        </div>                                              
                      </div>
                      <div class="form-group ">
                        <label>{{__('Notice')}}</label>
                         <textarea name="notice"   class="form-control"  ></textarea>
                      </div>                      
                      <button type="submit" id="btn_form" class="btn btn-primary">{{__('Submit')}}</button>
                      <span  id="close_btn_add" class="btn btn-primary" style="background-color: grey">{{__('Close')}}</span>
                    </form>                   
                  </div>
                </div>
        </div>
    </div>
 <!-- edit statge -->
     <div id="Overlay_edit" class="overlay">
        <div class="widget">
            <h3>Enter Information</h3>
           
                 <div class="card shadow mb-4">
                  <div class="card-header">
                    <strong  class="card-title">{{__('Edit statge')}}</strong>
                  </div>
                  <div class="card-body">
                    <form method="POST"  id="form_edit">
                      @csrf
                     @method('put')
                      <div class="form-row">
                        <div class="form-group ">
                          <label>{{__('Name')}}</label>
                          <input type="text" class="form-control" name="name" id="name_input">
                        </div>                                              
                      </div>
                      <div class="form-group ">
                        <label>{{__('Notice')}}</label>
                         <textarea name="notice"   class="form-control" id="notice_input" ></textarea>
                      </div>                      
                      <button type="submit" id="btn_form" class="btn btn-primary">Edit</button>
                      <span  id="close_btn_edit" class="btn btn-primary" style="background-color: grey">Close</span>
                    </form>                   
                  </div>
                </div>
        </div>
    </div>
     

      </main> <!-- main -->
    </div> <!-- .wrapper -->
         <script>
          //add
          $('#addWidgetBtn').click(function(){
             $('#Overlay_add').css('display','block')
          })

          //edit
          $('.edit_btn').click(function(){
               $('#Overlay_edit').css('display','block')
               $('#name_input').val($(this).data('name'))
               $('#notice_input').val($(this).data('notice'))
               $('#form_edit').attr('action', $(this).data('url'));               
            })
            //close edit
             $('#close_btn_edit,#close_btn_add').click(function(){
               $('#Overlay_add , #Overlay_edit').css('display','none')            
            })
   
</script>

        @include('layouts.footer')
   