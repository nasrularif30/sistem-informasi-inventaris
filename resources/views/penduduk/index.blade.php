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
            Managemen
        </div>
        <h2 class="page-title">
            Data Penduduk
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
                    <h3 class="card-title">Data Penduduk</h3>
                    <a id="addPenduduk" name="addPenduduk" type="button" class="btn btn-square btn-primary ms-auto" href="\penduduk\create">
                        <i class="ti ti-plus"></i>
                        Penduduk
                    </a>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="table-responsive">
                            <table class="table table-striped card-table table-vcenter text-nowrap datatable table-penduduk" id="tablePenduduk" style="width:100%">
                                <thead class="my-1">
                                    <tr>
                                        <th class="w-1">No</th>
                                        <th>Nama<br>Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Tanggal<br>Lahir</th>
                                        <th>Pekerjaan</th>
                                        <th>Agama</th>
                                        <th>Pendidikan</th>
                                        <th>KTP</th>
                                        <th>KK</th>
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
    @stack('scripts')
        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var tablePenduduk = $('.table-penduduk').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    ajax: "{{ route('penduduk.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'nama_lengkap', name: 'nama_lengkap'},
                        {data: 'alamat', name: 'alamat'},
                        {data: 'status', name: 'status'},
                        {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                        {data: 'pekerjaan', name: 'pekerjaan'},
                        {data: 'agama', name: 'agama'},
                        {data: 'pendidikan', name: 'pendidikan'},
                        {data: 'ktp_file', name: 'ktp_file'},
                        {data: 'kk_file', name: 'kk_file'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: false, 
                            searchable: false
                        },
                    ]
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
                                url: "{{ route('penduduk.destroy') }}"+'?id='+ id,
                                data: {_token: CSRF_TOKEN},
                                success: function (results) {
                                    if (results.success === true) {
                                        swal.fire("Sukses menghapus data!", results.message, "success");
                                        // refresh page after 2 seconds
                                        setTimeout(function(){
                                            tablePPenduduk.draw()
                                        },1500);
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
                
                $('body').on('click', '.edit', function () {
                    var id = $(this).data('id');
                    $.get("{{ route('penduduk.edit') }}" +'?id=' + id, function (data) {
                        window.location = "{{ route('penduduk.edit') }}" +'?id=' + id;
                    })
                });
            });  
    </script>
    <script  type="text/javascript" >
        </script>
        @endsection