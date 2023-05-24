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
                        Tambah user baru
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
                                        <!-- <th>Lokasi</th> -->
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
                        @include('users.edit')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
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
                        {data: 'leveldata', name: 'leveldata'},
                        // {data: 'id_lokasi', name: 'lokasi'},
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
                        $('#modalTitle').html("Edit Data User");
                        $('#id_user').val(id);
                        $('#nama').val(data[0].nama);
                        $('#old_username').val(data[0].username);
                        $('#username').val(data[0].username);
                        $('#level').val(data[0].leveldata);
                        $('#last_login').val(data[0].last_login);
                        $('#group_lastlogin').show();
                        $('#create_at').val(data[0].create_at);
                        $('#group_nama').show();
                        $('#group_username').show();
                        $('#group_level').show();
                        $('#group_createat').show();
                        $('#group_password').hide();
                        $('#group_confirmpassword').hide();
                        $('#btnEditUser').show();
                        $('#btnSaveUser').hide();
                        $('#modalUser').modal('show');
                        $('#btnEditUser').html('Simpan');
                        $('#btnChangePass').hide();
                    })
                });
                $('body').on('click', '.changepass', function () {
                    var id = $(this).data('id');
                    $.get("{{ route('users.edit') }}" +'?id=' + id, function (data) {
                        $('#modalTitle').html("Ubah Password <b>"+data[0].username+"</b>");
                        $('#id_user').val(id);
                        $('#group_lastlogin').hide();
                        $('#group_createat').hide();
                        $('#group_password').show();
                        $('#group_confirmpassword').show();
                        $('#group_nama').hide();
                        $('#group_username').hide();
                        $('#group_level').hide();
                        $('#btnEditUser').hide();
                        $('#btnSaveUser').hide();
                        $('#modalUser').modal('show');
                        $('#btnChangePass').show();
                        $('#btnChangePass').html('Simpan');
                    })
                });
                $('body').on('click', '.delete', function () {                
                var id = $(this).data("id");
                swal.fire({
                    title: "Delete?",
                    icon: 'question',
                    text: "Apakah anda yakin akan menghapus data ini?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, batalkan!",
                    reverseButtons: !0
                    }).then(function (e) {
                        if (e.value === true) {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                type: "GET",
                                url: "{{ route('users.delete') }}"+'?id='+id,
                                data: {_token: CSRF_TOKEN},
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses menghapus data!", results.message, "success");
                                        // refresh page after 2 seconds
                                        setTimeout(function(){
                                            table.draw();
                                        },1000);
                                    } else {
                                        swal.fire("Error!", results.message, "error");
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }
                            });
                        } else {
                            e.dismiss;
                        }

                    }, function (dismiss) {
                        return false;
                    })
                });
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
                            document.getElementById("formUser").reset();
                            $('#modalUser').modal("show");
                            $('#btnEditUser').hide();
                            $('#btnChangePass').hide();
                            $('#btnSaveUser').show();
                            $('#group_nama').show();
                            $('#group_username').show();
                            $('#group_level').show();
                            $('#group_lastlogin').hide();
                            $('#group_createat').hide();
                            $('#group_password').show();
                            $('#group_confirmpassword').show();
                            $('#modalTitle').html("Tambah User Baru");
                            $('#labelModalUser').html(result).show();
                            $('#btnSaveUser').html('Simpan');
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
                
                $('#btnSaveUser').click(function (e) {
                    e.preventDefault();
                    var password = $('#password').val();
                    var confirmpassword = $('#password-confirm').val();
                    var username = $('#username').val();
                    if($('#nama').val() == "" || $('#username').val() == "" || $('#password').val() == "" || $('#confirm-password').val() == ""){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        if(password != confirmpassword){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Password tidak cocok',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else{
                            if(username.length < 4){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Username harus lebih dari 3 karakter',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            else if(password.length < 5){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Password harus lebih dari 4 karakter',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            else{
                                $.ajax({
                                    data: $('#formUser').serialize(),
                                    url: "{{ route('users.create') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function (results) {
                                        if (results.success === true) {
                                            swal.fire("Sukses!", results.message, "success");
                                            // refresh page after 1 seconds
                                            setTimeout(function(){
                                                $('#formUser').trigger("reset");
                                                $('#modalUser').modal('hide');
                                                table.draw()
                                                location.reload();
                                            },1000);
                                        } else {
                                            swal.fire("Error!", results.message, "error");
                                        }
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                        $('#btnSaveUser').html('Simpan Perubahan');
                                    }
                                });
                            }
                        }
                    }                    
                });
                        
                $('#btnEditUser').click(function (e) {
                    e.preventDefault();
                    if($('#nama').val() == "" || $('#username').val() == ""){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        $.ajax({
                            url: "{{ url('users/store') }}",
                            type: "POST",
                            data: $('#formUser').serialize(),
                            dataType: 'json',
                            success: function (results) {
                                if (results.success === true) {
                                    swal.fire("Sukses!", results.message, "success");
                                    // refresh page after 1 seconds
                                    setTimeout(function(){
                                        $('#formUser').trigger("reset");
                                        $('#modalUser').modal('hide');
                                        table.draw()
                                        // location.reload();
                                    },1000);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                                $('#btnEditUser').html('Simpan Perubahan');
                            }
                        });
                    }
                });
                        
                $('#btnChangePass').click(function (e) {
                    e.preventDefault();
                    if($('#password').val() == "" || $('#password-confirm').val() == ""){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        var password = $('#password').val();
                        var confirmpassword = $('#password-confirm').val();
                        if(password != confirmpassword){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Password tidak cocok',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else{
                            $.ajax({
                                url: "{{ url('users/update') }}",
                                type: "POST",
                                data: $('#formUser').serialize(),
                                dataType: 'json',
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function(){
                                            $('#formUser').trigger("reset");
                                            $('#modalUser').modal('hide');
                                            table.draw()
                                            // location.reload();
                                        },1000);
                                    } else {
                                        swal.fire("Error!", results.message, "error");
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                    $('#btnChangePass').html('Simpan Perubahan');
                                }
                            });
                        }
                        
                    }
                });
            });  
    </script>
    <script  type="text/javascript" >
        </script>
        @endsection