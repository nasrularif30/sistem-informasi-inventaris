@extends('global.default')
@section('title', 'Peminjaman')
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
            Managemen
        </div>
        <h2 class="page-title">
            Peminjaman Barang
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
                    <h3 class="card-title">Data peminjaman barang</h3>
                    <button id="addPeminjaman" name="addPeminjaman" type="button" class="btn btn-square btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalPeminjaman">
                        <i class="ti ti-plus"></i>
                        Peminjaman
                    </button>
                    <button id="addBarang" name="addBarang" type="button" class="btn btn-square btn-secondary ms-1" data-bs-toggle="modal" data-bs-target="#modalBarang">
                        <i class="ti ti-plus"></i>
                        Barang
                    </button>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="table-responsive">
                            <table class="table table-striped card-table table-vcenter text-nowrap datatable table-barang" id="tableBarang" style="width:100%">
                                <thead class="my-1">
                                    <tr>
                                        <th class="w-1">No</th>
                                        <th>Nama</th>
                                        <th>Kode</th>
                                        <th>Jumlah<br>barang</th>
                                        <th>Status</th>
                                        <th>Kondisi</th>
                                        <!-- <th>Nama Peminjam</th> -->
                                        <th>Tanggal pinjam</th>
                                        <th>Tanggal kembali</th>
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
    <!-- inventaris modal -->
    <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="labelModalBarang"
        aria-hidden="true">
        <div class="modal-dialog md" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleBarang">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modalBarangBody">
                    <div>
                        @include('peminjaman.inventaris')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- peminjaman modal -->
    <div class="modal fade" id="modalPeminjaman" tabindex="-1" role="dialog" aria-labelledby="labelModalPeminjaman"
        aria-hidden="true">
        <div class="modal-dialog md" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Input Data Peminjaman</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modalPeminjamanBody">
                    <div>
                        @include('peminjaman.create')
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
                var table = $('.table-barang').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    ajax: "{{ route('peminjaman.list') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'nama_barang', name: 'nama_barang'},
                        {data: 'kode', name: 'kode'},
                        {data: 'jumlah_barang', name: 'jumlah_barang'},
                        {data: 'status', name: 'status'},
                        {data: 'kondisi', name: 'kondisi'},
                        // {data: 'nama_peminjam', name: 'nama_peminjam'},
                        {data: 'tanggal_pinjam', name: 'tanggal_pinjam'},
                        {data: 'tanggal_kembali', name: 'tanggal_kembali'},
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
                    $.get("{{ route('peminjaman.edit') }}" +'?id=' + id, function (data) {
                        $('#modalTitle').html("Edit Data Barang");
                        $('#btnSaveBarang').val("Edit Barang");
                        $('#id_Barang').val(id);
                        $('#nama').val(data[0].nama);
                        $('#old_Barangname').val(data[0].Barangname);
                        $('#Barangname').val(data[0].Barangname);
                        $('#level').val(data[0].level_id);
                        $('#last_login').val(data[0].last_login);
                        $('#group_lastlogin').show();
                        $('#create_at').val(data[0].create_at);
                        $('#group_createat').show();
                        $('#group_password').hide();
                        $('#group_confirmpassword').hide();
                        $('#btnEditBarang').show();
                        $('#btnSaveBarang').hide();
                        $('#modalBarang').modal('show');
                        $('#btnEditBarang').html('Simpan');
                    })
                });
                $('body').on('click', '.changepass', function () {
                    var id = $(this).data('id');
                    $.get("{{ route('peminjaman.edit') }}" +'?id=' + id, function (data) {
                        $('#modalTitle').html("Ubah Password <b>"+data[0].Barangname+"</b>");
                        $('#id_Barang').val(id);
                        $('#group_lastlogin').hide();
                        $('#group_createat').hide();
                        $('#group_password').show();
                        $('#group_confirmpassword').show();
                        $('#group_nama').hide();
                        $('#group_Barangname').hide();
                        $('#group_level').hide();
                        $('#btnEditBarang').hide();
                        $('#btnSaveBarang').hide();
                        $('#modalBarang').modal('show');
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
                                url: "{{ route('peminjaman.delete') }}"+'?id='+id,
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
                $(document).on('click', '#addBarang', function(event) {
                    event.preventDefault();
                    let href = $(this).attr('data-attr');
                    $.ajax({
                        url: href,
                        method: "GET",
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        // return the result
                        success: function(result) {
                            $('#modalBarang').modal("show");
                            $('#modalTitle').html("Tambah Barang Baru");
                            $('#labelModalBarang').html(result).show();
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
                
                // display a modal
                $(document).on('click', '#addPeminjaman', function(event) {
                    event.preventDefault();
                    let href = $(this).attr('data-attr');
                    $.ajax({
                        url: href,
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        // return the result
                        success: function(result) {
                            $('#modalPeminjaman').modal("show");
                            $('#modalTitle').html("Input Peminjaman Baru");
                            $('#labelModalPeminjaman').html(result).show();
                            $('.select2').select2( {
                                theme: "bootstrap-5",
                                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                                placeholder: $( this ).data( 'placeholder' ),
                                dropdownParent: $("#modalPeminjaman")
                            });
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

                $('#btnSaveBarang').click(function (e) {
                    e.preventDefault();
                    var kode = $('#kode').val();
                    if($('#nama_barang').val() == "" || $('#kode').val() == "" || $('#jumlah').val() == "" ){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        if(kode.length < 3){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Kode barang harus lebih dari 2 karakter',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                        else{
                            $.ajax({
                                data: $('#formBarang').serialize(),
                                url: "{{ route('peminjaman.create') }}",
                                type: "POST",
                                dataType: 'json',
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function(){
                                            $('#formBarang').trigger("reset");
                                            $('#modalBarang').modal('hide');
                                            table.draw()
                                        },1000);
                                    } else {
                                        swal.fire("Error!", results.message, "error");
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                    $('#btnSaveBarang').html('Simpan Perubahan');
                                }
                            });
                            
                        }
                    }                    
                });
                        
                $('#btnEditBarang').click(function (e) {
                    e.preventDefault();
                    if($('#nama').val() == "" || $('#Barangname').val() == ""){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        $.ajax({
                            url: "{{ url('peminjaman/store') }}",
                            type: "POST",
                            data: $('#formBarang').serialize(),
                            dataType: 'json',
                            success: function (results) {
                                if (results.success === true) {
                                    swal.fire("Sukses!", results.message, "success");
                                    // refresh page after 1 seconds
                                    setTimeout(function(){
                                        $('#formBarang').trigger("reset");
                                        $('#modalBarang').modal('hide');
                                        table.draw()
                                        // location.reload();
                                    },1000);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                                $('#btnEditBarang').html('Simpan Perubahan');
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
                                url: "{{ url('peminjaman/update') }}",
                                type: "POST",
                                data: $('#formBarang').serialize(),
                                dataType: 'json',
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function(){
                                            $('#formBarang').trigger("reset");
                                            $('#modalBarang').modal('hide');
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