@extends('global.default')
@section('title', 'Penduduk')
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
            Penduduk
        </div>
        <h2 class="page-title" id="title-page">
            Input Data
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
                    <h3 class="card-title">Input Data Penduduk</h3>
                    <a id="btnBack" name="btnBack" type="button" class="btn btn-square btn-warning ms-auto" href="/penduduk">
                        <i class="ti ti-arrow-left"></i>
                        Kembali
                    </a>
                    </div>
                    <form id="formPenduduk" name="formPenduduk" class="form" action="{{ route('penduduk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body border-bottom py-3">
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">NIK</label>
                                <div class="col">
                                    <input type="text" class="form-control"  placeholder="NIK" id="nik" name="nik" max="16">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Nama Lengkap</label>
                                <div class="col">
                                    <input type="text" class="form-control"  placeholder="Nama Lengkap" id="nama" name="nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Jenis Kelamin</label>
                                <div class="col">
                                    <select class="form-control form-select " name="jenis_kelamin" id="jenis_kelamin" placeholder="jenis_kelamin">
                                        <option selected disabled>Jenis Kelamin</option>
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Alamat</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="alamat" id="alamat" placeholder="alamat">
                                        <option selected disabled>Alamat</option>
                                        @foreach($data_alamat as $alamat)
                                        <option value="{{$alamat->id}}">{{$alamat->alamat_lengkap}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Tanggal Lahir</label>
                                <div class="col">
                                    <input class="form-control " placeholder="tanggal lahir" name="tgl_lahir" id="tgl_lahir" type="date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Tempat Lahir</label>
                                <div class="col">
                                    <input class="form-control " placeholder="tempat lahir" name="tempat_lahir" id="tempat_lahir" type="text">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Pekerjaan</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="pekerjaan" id="pekerjaan" placeholder="pekerjaan">
                                        <option selected disabled>Pekerjaan</option>
                                        @foreach($data_pekerjaan as $pekerjaan)
                                        <option value="{{$pekerjaan->id}}">{{$pekerjaan->pekerjaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Pendidikan</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="pendidikan" id="pendidikan" placeholder="pendidikan">
                                        <option selected disabled>Pendidikan</option>
                                        @foreach($data_pendidikan as $pendidikan)
                                        <option value="{{$pendidikan->id}}">{{$pendidikan->pendidikan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Agama</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="agama" id="agama" placeholder="agama">
                                        <option selected disabled>Agama</option>
                                        @foreach($data_agama as $agama)
                                        <option value="{{$agama->id}}">{{$agama->nama_agama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label">File KTP</label>
                                <div class="col">
                                    <input class="form-control " placeholder="pilih file ktp" name="file_ktp" id="file_ktp" type="file">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label class="col-3 col-form-label">File Kartu Keluarga</label>
                                <div class="col">
                                    <input class="form-control " placeholder="pilih file kk" name="file_kk" id="file_kk" type="file">
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
                        $.ajax({
                            data: $('#formPenduduk').serialize(),
                            url: "{{ route('penduduk.store') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function (results) {
                                if (results.success === true) {
                                    swal.fire("Sukses!", results.message, "success");
                                    // refresh page after 1 seconds
                                    setTimeout(function(){
                                        $('#formPenduduk').trigger("reset");
                                        location.reload();
                                    },1000);
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