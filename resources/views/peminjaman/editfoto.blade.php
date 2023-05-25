<div class="col-md-12">
    <form id="formBarang" name="formBarang" class="form" enctype="multipart/form-data" >
        @csrf
        <div class="row mb-3" id="group_nama">
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
        </div>
        <div class="row g-2 g-md-3 mt-3">
            @foreach($dataFoto as $fb)
            <div class="col-6">
                <div class="card">
                    <div class="img-responsive img-responsive rounded-3 border" style="background-image: url('{{url($fb->foto_barang)}}')"></div>
                    <a data-id="{{$fb->id}}" data-path="{{$fb->foto_barang}}" data-id-barang="{{$fb->id_barang}}" class="deleteFoto btn btn-warning">delete</a>
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>
