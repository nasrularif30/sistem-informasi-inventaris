@extends('global.default')
@section('title', 'Penduduk')

@section('content')

<!-- Page body -->
<div class="page-body"><div class="card">
    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>ALAMAT</th>
                        <th>TANGGAL LAHIR</th>
                        <th>PEKERJAAN</th>
                        <th>AGAMA</th>
                        <th>PENDIDIKAN</th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
        </table>
    </div>
    </div>
</div>
</div>
    @stack('scripts')
        @endsection