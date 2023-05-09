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
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ $data[0]['nama'] ?? '' }}" readonly  autofocus>
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
                                    <input id="password" type="password" class="form-control" value="" name="password" readonly autocomplete="new-password">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label ">Confirm New Password</label>
                                <div class="col">
                                    <input id="password-confirm" type="password" class="form-control" value="" readonly name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button id="btnSavePenduduk" value="create" class="btn btn-primary">
                                        <i class="ti ti-device-floppy"></i>
                                        Simpan
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
            function preview(param) {
                if(param == 'ktp') previewKtp.src = URL.createObjectURL(event.target.files[0]);
                
            }

                $('#btnSavePenduduk').click(function (e) {
                    e.preventDefault();
                    if($('#nik').val() == "" || $('#nama').val() == "" || $('#jenis_kelamin').val() == ""  || $('#alamat').val() == ""  || $('#tgl_lahir').val() == ""  || $('#tempat_lahir').val() == ""  || $('#pekerjaan').val() == ""  || $('#pendidikan').val() == ""  || $('#agama').val() == "" ){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        let form = document.getElementById('formPenduduk')
                        let formData = new FormData(form);
                        $.ajax({
                            data: formData,
                            url: "{{ route('penduduk.store') }}",
                            type: "POST",
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            success: function (results) {
                                if (results.success === true) {
                                    swal.fire("Sukses!", results.message, "success");
                                    // refresh page after 1 seconds
                                    setTimeout(function(){
                                        $('#formPenduduk').trigger("reset");
                                        location.reload();
                                    },1500);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                                $('#btnSavePenduduk').html('Simpan Perubahan');
                            }
                        });
                    }                    
                });
                
            });

    </script>
    <script  type="text/javascript" >
        </script>
        @endsection