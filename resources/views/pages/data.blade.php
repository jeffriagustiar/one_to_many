@extends('layouts.home')

@push('')
    
@endpush

@section('title')
    CRUD
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tables</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">CRUD</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M448 32C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM224 256V160H64V256H224zM64 320V416H224V320H64zM288 416H448V320H288V416zM448 256V160H288V256H448z"></path></svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                DataTable CRUD
            </div>
            <div class="col-sm-4">
                <a href="#" class="btn btn-primary" id="addData">Add Data</a>
            </div>
            <div class="card-body">
                {{-- <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"> --}}
                    {{-- <div class="dataTable-container"> --}}
                        <table id="datacrud" class="dataTable-table">
                            <thead>
                                <tr>
                                    <th>Name</a></th>
                                    <th>Email</a></th>
                                    <th>Level</a></th>
                                    <th>Action</a></th>
                                </tr>
                            </thead>
                        </table>
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </main>

        <div class="modal fade modalEdit" id="addDataModal" tabindex="-1" aria-labelledby="addData" aria-hidden="true">
            <div class="modal-dialog modal-m modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addData">Add Data User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="postData" name="postData" class="form-horizontal form" >
          
                    <div class="mb-3 row">
                      <label class="col-sm-2 control-label">Name</label>
                      <div class="col-lg-12">
                        <div class="input-group">
                            <input type="hidden" name="id">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" >
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-lg-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="" >
                          </div>
                        </div>
                      </div>

                      <div class="mb-3 row">
                          <label class="col-sm-2 control-label">Password</label>
                          <div class="col-lg-12">
                            <div class="input-group">
                              <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" value="" >
                            </div>
                          </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-2 control-label">Level</label>
                            <div class="col-lg-12">
                              <div class="input-group">
                                <input type="text" class="form-control" id="level" name="level" placeholder="Enter Level" value="" >
                              </div>
                            </div>
                          </div>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-add" id="savedata" value="create">Save Post</button>
                      <button type="submit" class="btn btn-primary btn-edit" id="savedataedit" value="create">Save Post</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('after-script')


        <script>

            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var modal = $('.modalEdit')
                var form = $('.form')

                var datat = $('#datacrud').DataTable({
                    processing: true,
                    serverside: true,
                    ajax: '/getdata',
                    columns: [
                        { data: 'name', name:'name' },
                        { data: 'email', name:'email' },
                        { data: 'level', name:'level' },
                        { data: 'action', name:'action' },
                    ]
                });

                $('body').on('click', '.deleteData', function(){
                    var id = $(this).data("id");
                    $.ajax({
                        type: "DELETE",
                        url: '/deletedata/'+id,
                        success : function (data){
                            datat.ajax.reload()
                            console.log("success")
                        },
                        error: function (data){
                            console.log("Error : ",data);
                        }
                    })
                });

                $('#addData').click(function (){
                    $('#addDataModal').modal('show');
                    $('#savedataedit').hide();
                    $('#savedata').show();
                });

                $('#savedata').click(function (){
                    $.ajax({
                        data: $('#postData').serialize(),
                        url: '/adddata',
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                            $('$postData').trigger("reset");
                            $('$addDataModal').modal('hide');
                            datat.ajax.reload();
                        },
                        error: function(data){
                            console.log('Error: ',data);
                        }
                    })
                })

                $('body').on('click', '.lookData', function(){
                    var id = $(this).data("id");
                    modal.modal('show');
                    $('#savedataedit').show();
                    $('#savedata').hide();

                    modal.find('.modal-title').text('Update Data');

                    var data= datat.row($(this).parents('tr')).data()

                    form.find('input[name="id"]').val(data.id)
                    form.find('input[name="name"]').val(data.name)
                    form.find('input[name="email"]').val(data.email)
                    form.find('input[name="level"]').val(data.level)

                    console.log(id);
                    console.log("test");
                });

                $('#savedataedit').click(function(){
                    var id = form.find('input[name="id"]').val()
                    $.ajax({
                        type:"POST",
                        data: form.serialize(),
                        dataType: 'json',
                        url: '/updatedata/'+id,
                        success: function(data){
                            form.trigger("reset");
                            modal.modal('hide');
                            datat.ajax.relod();
                        },
                        error: function(data){
                            console.log(data);
                        }
                    })
                })

            });
            
            

        </script>
@endpush