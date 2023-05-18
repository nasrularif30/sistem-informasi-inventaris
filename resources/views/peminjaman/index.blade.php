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
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="table-responsive">
                            <table class="table table-striped card-table table-vcenter text-nowrap datatable table-peminjaman" id="tablePeminjaman" style="width:100%">
                                <thead class="my-1">
                                    <tr>
                                        <th class="w-1">No</th>
                                        <th>Nama<br>Barang</th>
                                        <th>Nama<br>Peminjam</th>
                                        <th>Jumlah<br>Barang</th>
                                        <th>Status</th>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Data barang</h3>
                    <button id="addBarang" name="addBarang" type="button" class="btn btn-square btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#modalBarang">
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
                                        <th>Nama<br>Barang</th>
                                        <th>Spesifikasi<br>Barang</th>
                                        <th>Status</th>
                                        <th>Ketersediaan</th>
                                        <th>Kondisi</th>
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
                    <h5 class="modal-title" id="modalTitleBarang">Tambah Inventaris Baru</h5>
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
    <!-- detail modal -->
    <div class="modal modal-blur fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="labelModalDetail"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Detail Inventaris</h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modalDetailBody">
                    <div>
                        @include('peminjaman.detail')
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

                var tablePeminjaman = $('.table-peminjaman').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    ajax: "{{ route('peminjaman.list') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'nama_barang', name: 'nama_barang'},
                        {data: 'nama_peminjam', name: 'nama_peminjam'},
                        // {data: 'kode', name: 'kode'},
                        {data: 'jumlah', name: 'jumlah_peminjaman'},
                        {data: 'status', name: 'status'},
                        // {data: 'kondisi', name: 'kondisi'},
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
                var tableBarang = $('.table-barang').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    ajax: "{{ route('peminjaman.inventaris') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'nama', name: 'nama'},
                        {data: 'spek', name: 'spek'},
                        {data: 'status', name: 'status'},
                        {data: 'ketersediaan', name: 'ketersediaan'},
                        {data: 'kondisi', name: 'kondisi'},
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
                    var param = 'peminjaman'
                    $.get("{{ route('peminjaman.edit') }}" +'?id=' + id + '&param=peminjaman', function (data) {
                        $('#modalTitle').html("Edit Data Peminjaman");
                        $('#btnSavePinjam').html("Update");
                        $('#id_peminjaman').val(data[0].id);
                        $('#id_peminjam').val(data[0].id_peminjam);
                        $('#id_barang_peminjaman').val(data[0].id_barang);
                        $("#nama_barang_peminjaman").val(data[0].id_barang);
                        $("#nama_barang_peminjaman").prop('disabled', true);
                        $('#nama_peminjam').val(data[0].id_peminjam);
                        $('#nama_peminjam').prop('disabled', true);
                        $('#jumlah_peminjaman').val(data[0].jumlah);
                        $('#jml_peminjaman').val(data[0].jumlah);
                        $('#jumlah_peminjaman').prop('disabled', true);
                        $('#tgl_peminjaman').val(data[0].tanggal_pinjam);
                        $('#tgl_kembali').val(data[0].tanggal_kembali);
                        $('#status_peminjaman').val(data[0].status_peminjaman);
                        data[0].status_peminjaman == 2 ? $("#status_peminjaman").prop('disabled', true) : $("#status_peminjaman").prop('disabled', false);
                        $('#modalPeminjaman').modal('show');
                    })
                });
                $('body').on('click', '.delete', function () {                
                var id = $(this).data("id");
                var param = $(this).data("param");
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
                                url: "{{ route('peminjaman.delete') }}"+'?id='+ id + '&param=' + param,
                                data: {_token: CSRF_TOKEN},
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses menghapus data!", results.message, "success");
                                        // refresh page after 2 seconds
                                        setTimeout(function(){
                                            tablePeminjaman.draw()
                                            tableBarang.draw()
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
                $('body').on('click', '.editBarang', function () {
                    var id = $(this).data('id');
                    var param = 'barang';
                    $.get("{{ route('peminjaman.edit') }}" +'?id=' + id + '&param=barang', function (data) {
                        $('#modalTitleBarang').html("Edit Data Inventaris");
                        $('#btnSaveBarang').html("Update");
                        $('#id_barang').val(data[0].id);
                        $("#nama_barang").val(data[0].nama);
                        $("#spek").val(data[0].spek);
                        $('#kode').val(data[0].kode);
                        $('#total_stok').val(data[0].total_stok);
                        $('#kondisi').val(data[0].kondisi);
                        $('#status').val(data[0].status);
                        $('#status').prop('disabled', true);
                        $('#modalBarang').modal('show');
                    })
                });
                $('body').on('click', '.detailBarang', function () {
                    var id = $(this).data('id');
                    var param = 'barang';
                    $.get("{{ route('peminjaman.detail') }}" +'?id=' + id, function (data) {
                        $('#modalTitleDetail').html("Detail Inventaris");
                        $('#modalDetail').modal('show');
                        $('#modalDetailBody').html(data)
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
                            $('#btnSaveBarang').html('Simpan');
                            $('#modalTitleBarang').html("Tambah Barang Baru");
                            $('#formBarang').trigger("reset");
                            $('#id_barang').val('');
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
                            $('#jumlah_peminjaman').prop('disabled', false);
                            $('#nama_peminjam').prop('disabled', false);
                            $("#nama_barang_peminjaman").prop('disabled', false);
                            $("#status_peminjaman").prop('disabled', false);
                            $('#btnSavePinjam').html('Simpan');
                            $('#id_peminjaman').val('');
                            $('#formPeminjaman').trigger("reset");
                            $('#jumlah').attr({
                                "min" : 1
                            })
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
                    if($('#nama_barang').val() == "" || $('#spek').val() == "" || $('#jumlah').val() == "" ){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        // $('#formBarang').submit(function(e) {
                        //     e.preventDefault();
                        //     var formData = new FormData(this);
                        //     $.ajax({
                        //         type: 'POST',
                        //         url: "{{ route('peminjaman.create') }}",
                        //         data: formData,
                        //         cache: false,
                        //         contentType: false,
                        //         processData: false,
                        //         success: (results) => {
                        //             if (results.success === true) {
                        //                 swal.fire("Sukses!", results.message, "success");
                        //                 // refresh page after 1 seconds
                        //                 setTimeout(function(){
                        //                     $('#formBarang').trigger("reset");
                        //                     $('#modalBarang').modal('hide');
                        //                     tablePeminjaman.draw()
                        //                     tableBarang.draw()
                        //                 },1000);
                        //             } else {
                        //                 swal.fire("Error!", results.message, "error");
                        //             }
                        //         },
                        //         error: function (data) {
                        //             console.log('Error:', data);
                        //             $('#btnSaveBarang').html('Simpan Perubahan');
                        //         }
                        //     });
                        // });
                        
                        let param = $('#param').val();
                        let id_barang = $('#id_barang').val();
                        let nama_barang = $('#nama_barang').val();
                        let spek = $('#spek').val();
                        let kondisi = $('#kondisi').val();
                        let status = $('#status').val();
                        let total_stok = $('#total_stok').val();
                        let kode = $('#kode').val();

                        let totalFoto = $('#foto_barang')[0].files.length;
                        console.log('banyak foto: '+totalFoto);
                        let files = $('#foto_barang')[0];
                        var formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}')
                        formData.append('param', param)
                        formData.append('id_barang', id_barang)
                        formData.append('nama_barang', nama_barang)
                        formData.append('spek', spek)
                        formData.append('kondisi', kondisi)
                        formData.append('status', status)
                        formData.append('total_stok', total_stok)
                        formData.append('kode', kode)
                        for (let i = 0; i < totalFoto; i++) {
                            formData.append('foto_barang' + i, files.files[i]);
                        }
                        formData.append('totalFoto', totalFoto);
                        $.ajax({
                            // data: $('#formBarang').serialize(),
                            url: "{{ route('peminjaman.create') }}"+'?_token=' + '{{ csrf_token() }}',
                            type: "post",
                            dataType: 'json',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (results) {
                                if (results.success === true) {
                                    swal.fire("Sukses!", results.message, "success");
                                    // refresh page after 1 seconds
                                    setTimeout(function(){
                                        $('#formBarang').trigger("reset");
                                        $('#modalBarang').modal('hide');
                                        tablePeminjaman.draw()
                                        tableBarang.draw()
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
                });
                        
                $('#btnEditBarang').click(function (e) {
                    e.preventDefault();
                    if($('#nama').val() == "" || $('#spek').val() == ""){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        data = {};
                        data.param = $('#param').val();
                        data.id_barang = $('#id_barang').val();
                        data.nama_barang = $('#nama_barang').val();
                        data.spek = $('#spek').val();
                        data.kondisi = $('#kondisi').val();
                        data.status = $('#status').val();
                        data.total_stok = $('#total_stok').val();
                        data.foto_barang = $('#foto_barang').val();
                        data.kode = $('#kode').val();
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
                                        tablePeminjaman.draw()
                                        tableBarang.draw()
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
                        
                $('#btnSavePinjam').click(function (e) {
                    e.preventDefault();
                    if($('#nama_peminjam').val() == "" || $('#nama_barang_peminjaman').val() == "" || $('#jumlah').val() == ""  || $('#tgl_pinjam').val() == "" || $('#tgl_kembali').val() == ""){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else{
                        if($('#jumlah').val() < 1){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Masukkan jumlah barang dengan benar!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                        else{
                            $.ajax({
                                data: $('#formPeminjaman').serialize(),
                                url: "{{ route('peminjaman.create') }}",
                                type: "POST",
                                dataType: 'json',
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function(){
                                            $('#formPeminjaman').trigger("reset");
                                            $('#modalPeminjaman').modal('hide');
                                            tablePeminjaman.draw()
                                            tableBarang.draw()
                                        },1500);
                                    } else {
                                        swal.fire("Error!", results.message, "error");
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                    $('#btnSavePeminjaman').html('Simpan Perubahan');
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