<div class="col-md col-lg">
    <table class="table card-table table-vcenter">
        <tbody>
            <tr>
                <td>Nama inventaris</td>
                <td>{{ $data->nama ?? '' }}</td>
            </tr>
            <tr>
                <td>Ketersediaan</td>
                <td>{{ $data->ketersediaan ?? '' }}</td>
            </tr>
            <tr>
                <td>Kondisi</td>
                <td>{{ $data->kondisi ?? '' }}</td>
            </tr>
            <tr>
                <td>Detail Spesifikasi</td>
                <td>{{ $data->spek ?? '' }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row g-2 g-md-3 mt-3">
        @foreach($dataFoto as $fb)
        <div class="col-6">
                <!-- Photo -->
                <div class="img-responsive img-responsive rounded-3 border" style="background-image: url('{{url($fb->foto_barang)}}')"></div>
        </div>
        @endforeach
    </div>
</div>