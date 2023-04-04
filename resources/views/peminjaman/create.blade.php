<div class="col-md-12">
    <form id="formBarang" name="formBarang" class="form">
        @csrf
        <div class="row mb-3" id="group_nama">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Barang</label>
            <div class="col-md-6">
                <input id="id_barang" name="id_barang" type="hidden" class="form-control" value="">
                <input id="nama" type="text" class="form-control" name="nama" value="" required autofocus>
            </div>
        </div>
        <div class="row mb-3" id="group_kode">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Kode Barang</label>
            <div class="col-md-6">
                <input id="old_kode" type="text" class="form-control" name="old_kode" value="" hidden>
                <input id="kode" type="text" class="form-control" name="kode" value="" required autofocus>
            </div>
        </div>
        <div class="row mb-3" id="group_status">
            <label class="col-md-4 col-form-label text-md-end">Status</label>
            <div class="col-md-6">
                <select class="form-select" id="status" name="status">
                    <option value="1" selected>Ada</option>
                    <option value="0">Tidak Ada</option>
                </select>
            </div>
        </div>
        <div class="row mb-3" id="group_kondisi">
            <label class="col-md-4 col-form-label text-md-end">Kondisi</label>
            <div class="col-md-6">
                <select class="form-select" id="kondisi" name="kondisi">
                    <option value="Baik" selected>Baik</option>
                    <option value="Cukup">Cukup Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="btnSavePinjam" value="create" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
