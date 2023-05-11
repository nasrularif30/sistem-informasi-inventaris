@extends('global.default')
@section('title', 'Profile')
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
            User
        </div>
        <h2 class="page-title" id="title-page">
            Profile
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
                    <form id="formProfile" name="formProfile" class="form">
                        @csrf
                        <div class="card-body border-bottom py-3">
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label ">Nama</label>
                                <div class="col">
                                    <input id="id_user" name="id_user" type="hidden" class="form-control" value="{{ $data[0]['id'] ?? '' }}">
                                    <input id="id_warga" name="id_warga" type="hidden" class="form-control" value="{{ $data[0]['id_warga'] ?? '' }}">
                                    <input id="old_username" name="old_username" type="hidden" class="form-control" value="{{ $data[0]['username'] ?? '' }}">
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ $data[0]['nama'] ?? '' }}" autofocus>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label ">Username</label>
                                <div class="col">
                                    <input type="text" class="form-control" readonly  placeholder="Username" id="username" name="username" value="{{ $data[0]['username'] ?? '' }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label ">Level</label>
                                <div class="col">
                                    <input type="text" class="form-control" readonly  placeholder="Level" id="level" name="level" value="{{ $data[0]['level'] ?? '' }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label ">Reset Password</label>
                                <div class="col">
                                    <input id="password" type="password" class="form-control" value="" name="password" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label ">Confirm New Password</label>
                                <div class="col">
                                    <input id="password-confirm" type="password" class="form-control" value="" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-3">
                                    <button id="btnEditUser" value="create" class="btn btn-primary">
                                        <i class="ti ti-edit"></i>
                                        Update Profile
                                    </button>
                                    <button id="btnChangePass" value="change" class="btn btn-warning">
                                        <i class="ti ti-key"></i>
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @stack('scripts')
        <script type="text/javascript">
            $(function () {
                $('.select2').select2( {
                    theme: "bootstrap-5",
                    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                    placeholder: $( this ).data( 'placeholder' )
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
                            data: $('#formProfile').serialize(),
                            dataType: 'json',
                            success: function (results) {
                                if (results.success === true) {
                                    swal.fire("Sukses!", results.message, "success");
                                    // refresh page after 1 seconds
                                    setTimeout(function(){
                                        // $('#formUser').trigger("reset");
                                        // $('#modalUser').modal('hide');
                                        // table.draw()
                                        location.reload();
                                    },1000);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                                $('#btnEditUser').html('Update User');
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
                                data: $('#formProfile').serialize(),
                                dataType: 'json',
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function(){
                                            // $('#formUser').trigger("reset");
                                            // $('#modalUser').modal('hide');
                                            // table.draw()
                                            location.reload();
                                        },1000);
                                    } else {
                                        swal.fire("Error!", results.message, "error");
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                    $('#btnChangePass').html('Change Password');
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