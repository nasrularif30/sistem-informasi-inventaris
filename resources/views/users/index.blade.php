@extends('global.default')
@section('title', 'User Management')
@show
@section('header')
    @include('global.header')
@section('navbar')
    @include('global.navbar')
@show
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Table
        </div>
        <h2 class="page-title">
            User Management
        </h2>
        </div>
    </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Data user akses</h3>
                    <button id="addUser" name="addUser" type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalUser">
                        <i class="ti ti-plus"></i>
                        Create New User
                    </button>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="table-responsive">
                            <table class="table table-striped card-table table-vcenter text-nowrap datatable table-user" id="tableUser" style="width:100%">
                                <thead class="my-1">
                                    <tr>
                                        <th class="w-1">No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- register modal -->
    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="labelModalUser"
        aria-hidden="true">
        <div class="modal-dialog md" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New User</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modalUserBody">
                    <div>
                        @include('auth.register')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- edit modal -->
    <div class="modal fade" id="modalUserEdit" tabindex="-1" role="dialog" aria-labelledby="labelModalUser"
        aria-hidden="true">
        <div class="modal-dialog md" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleEdit">Edit Data User</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modalUserEditBody">
                    <div>
                        @include('users.edit')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
    <script  type="text/javascript" >
        // display a modal
        $(document).on('click', '#addUser', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#modalAddUser').modal("show");
                    $('#modalTitle').val("Add New User");
                    $('#labelModalUser').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        </script>
        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var table = $('.table-user').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    ajax: "{{ route('users.list') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'nama', name: 'nama'},
                        {data: 'username', name: 'username'},
                        {data: 'level', name: 'level'},
                        {data: 'id_lokasi', name: 'lokasi'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: false, 
                            searchable: false
                        },
                    ]
                }); 
                $('body').on('click', '.edit', function () {
                    var id = $(this).data('id');
                    $.get("{{ route('users.edit') }}" +'?id=' + id, function (data) {
                        $('#modalTitleEdit').html("Edit Data User");
                        $('#savedata').val("edit-user");
                        $('#modalUserEdit').modal('show');
                        $('#nama').val(data.nama);
                        $('#username').val(data.username);
                        $('#level').val(data.level_id);
                        $('#last_login').val(data.last_login);
                        $('#create_at').val(data.create_at);
                    })
                });
                    
                $('body').on('click', '.delete', function () {
                
                var id = $(this).data("id");
                confirm("Apakah anda yakin menghapus data ini?");
            
                $.ajax({
                    type: "GET",
                    url: "{{ route('users.delete') }}"+'?id='+id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
            });  
                  
            // function edit(id){
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            //     });
            //     $.ajax({
            //     type:"POST",
            //     url: "{{ route('users.edit') }}",
            //     data: { id: id },
            //     dataType: 'json',
            //     success: function(res){
            //             $('#modalTitle').html("Edit User");
            //             $('#modalUserBody').modal('show');
            //         //   $('#user_id').val(res.id);
            //             $('#nama').val(res.nama);
            //             $('#username').val(res.username);
            //             $('#level').val(res.level_id);
            //         //   $('#last_login').val(res.last_login);
            //         //   $('#create_at').val(res.create_at);
            //         }
            //     });
            // }
    </script>
        @endsection