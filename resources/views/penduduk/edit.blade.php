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
                    <h3 class="card-title">Edit Data Penduduk</h3>
                    <a id="btnReset" name="btnReset" type="button" class="btn btn-square btn-danger ms-auto" href="/penduduk/create">
                        <i class="ti ti-reload"></i>
                        Reset Form
                    </a>
                    <a id="btnBack" name="btnBack" type="button" class="btn btn-square btn-warning ms-1" href="/penduduk">
                        <i class="ti ti-arrow-left"></i>
                        Kembali
                    </a>
                    </div>
                    <form id="formPenduduk" name="formPenduduk" class="form">
                        @csrf
                        <div class="card-body border-bottom py-3">
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">NIK</label>
                                <div class="col">
                                    <input type="text" class="form-control"  placeholder="NIK" id="id" name="id" hidden value="{{ $data[0]['id'] ?? '' }}">
                                    <input type="text" class="form-control"  placeholder="NIK" id="nik" name="nik" maxlength="16" value="{{ $data[0]['nik'] ?? ''}}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Nama Lengkap</label>
                                <div class="col">
                                    <input type="text" class="form-control"  placeholder="Nama Lengkap" id="nama" name="nama" value="{{ $data[0]['nama_lengkap'] ?? '' }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Jenis Kelamin</label>
                                <div class="col">
                                    <select class="form-control form-select " name="jenis_kelamin" id="jenis_kelamin" placeholder="jenis_kelamin">
                                        <option {{ $data[0]['jenis_kelamin'] ?? 'selected'}} disabled>Jenis Kelamin</option>
                                        <option {{ $data[0]['jenis_kelamin'] == 1 ? 'selected' : ''}} value="1">Laki-laki</option>
                                        <option {{ $data[0]['jenis_kelamin'] == 2 ? 'selected' : ''}} value="2">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Alamat</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="alamat" id="alamat" placeholder="alamat">
                                        <option {{ $data[0]['alamat'] ?? 'selected' }} disabled>Alamat</option>
                                        @foreach($data_alamat as $alamat)
                                        <option {{ $alamat->id == $data[0]['alamat'] ? 'selected' : ''}} value="{{$alamat->id}}">{{$alamat->alamat_lengkap}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Status Warga</label>
                                <div class="col">
                                    <select class="form-control form-select " name="status_warga" id="status_warga" placeholder="status_warga">
                                        <option {{ $data[0]['status'] ?? 'selected'}} disabled>Jenis Kelamin</option>
                                        <option {{ $data[0]['status'] == 'Penduduk' ? 'selected' : ''}} value="Penduduk">Penduduk</option>
                                        <option {{ $data[0]['status'] == 'Kost' ? 'selected' : ''}} value="Kost">Kost</option>
                                        <option {{ $data[0]['status'] == 'Kontrak' ? 'selected' : ''}} value="Kontrak">Kontrak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Tanggal Lahir</label>
                                <div class="col">
                                    <input class="form-control " placeholder="tanggal lahir" name="tgl_lahir" id="tgl_lahir" type="date" value="{{ $data[0]['tanggal_lahir']  ?? '' }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Tempat Lahir</label>
                                <div class="col">
                                    <input class="form-control " placeholder="tempat lahir" name="tempat_lahir" id="tempat_lahir" type="text" value="{{ $data[0]['tempat_lahir']  ?? '' }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Pekerjaan</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="pekerjaan" id="pekerjaan" placeholder="pekerjaan">
                                        <option {{ $data[0]['pekerjaan'] ?? 'selected' }} disabled>Pekerjaan</option>
                                        @foreach($data_pekerjaan as $pekerjaan)
                                        <option {{ $data[0]['pekerjaan'] == $pekerjaan->id ? 'selected' : ''}} value="{{$pekerjaan->id}}">{{$pekerjaan->pekerjaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Pendidikan</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="pendidikan" id="pendidikan" placeholder="pendidikan">
                                        <option {{ $data[0]['pendidikan'] ?? 'selected' }} disabled>Pendidikan</option>
                                        @foreach($data_pendidikan as $pendidikan)
                                        <option {{ $data[0]['pendidikan'] == $pendidikan->id ? 'selected' : ''}} value="{{$pendidikan->id}}">{{$pendidikan->pendidikan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">Agama</label>
                                <div class="col">
                                    <select class="form-control form-select select2" name="agama" id="agama" placeholder="agama">
                                        <option {{ $data[0]['agama'] ?? 'selected' }} disabled>Agama</option>
                                        @foreach($data_agama as $agama)
                                        <option {{ $data[0]['agama'] == $agama->id ? 'selected' : ''}} value="{{$agama->id}}">{{$agama->nama_agama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label">File KTP</label>
                                <div id="accordionKTP" class="col-sm-5 accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKTP" aria-expanded="false">
                                                Preview File KTP
                                            </button>
                                        </h2>
                                        <div id="collapseKTP" class="accordion-collapse collapse" data-bs-parent="#accordionKTP" style="">
                                            <div class="accordion-body pt-0">
                                                <img id="previewKtp" src="{{ url('/')}}/file/{{ $data[0]['nik'] ?? ''}}/{{ $data[0]['ktp_file'] ?? ''}}" class="img-fluid" style="max-width:400px"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <input class="form-control " placeholder="pilih file ktp" name="file_ktp" id="file_ktp" type="file" value="{{ $data[0]['ktp_file']  ?? '' }}">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label class="col-3 col-form-label">File Kartu Keluarga</label>
                                <div id="accordionKK" class="col-sm-5 accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKK" aria-expanded="false">
                                                Preview File Kartu Keluarga
                                            </button>
                                        </h2>
                                        <div id="collapseKK" class="accordion-collapse collapse" data-bs-parent="#accordionKK" style="">
                                            <div class="accordion-body pt-0">
                                                <img id="previewKk" src="{{ url('/')}}/file/{{ $data[0]['nik'] ?? ''}}/{{ $data[0]['kk_file'] ?? ''}}" class="img-fluid" style="max-width:400px"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <input class="form-control " placeholder="pilih file kk" name="file_kk" id="file_kk" type="file" value="{{ $data[0]['kk_file']  ?? '' }}">
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