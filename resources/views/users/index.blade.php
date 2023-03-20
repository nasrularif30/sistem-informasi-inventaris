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
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable table-user" id="tableUser">
                            <thead>
                            <tr>
                                <th class="w-1">No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
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
    @push('script')
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
            var table = $('.table-user').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                ajax: "{{ route('users.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'username', name: 'username'},
                    {data: 'level', name: 'level'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    },
                ]
            });
            
            });
    </script>
    @endpush
        @endsection