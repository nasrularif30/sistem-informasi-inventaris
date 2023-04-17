<div class="col-md-12">
    <form id="formBarang" name="formBarang" class="form">
        @csrf
        <div class="row mb-3" id="group_nama">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Barang</label>
            <div class="col-md-6">
                <input id="id_barang" name="id_barang" type="hidden" class="form-control" value="">
                <input id="param" name="param" type="hidden" class="form-control" value="barang">
                <input id="nama_barang" type="text" class="form-control" name="nama_barang" placeholder="Sound System" value="" required autofocus>
            </div>
        </div>
        <div class="row mb-3" id="group_kode" style="display:none">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Kode Barang</label>
            <div class="col-md-6">
                <input id="old_kode" type="text" class="form-control" name="old_kode" value="" hidden>
                <input id="kode" type="text" class="form-control" name="kode" placeholder="SS01" value="" required autofocus>
            </div>
        </div>
        <div class="row mb-3" id="group_spek">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Spesifikasi Barang</label>
            <div class="col-md-6">
                <textarea id="spek" type="text" class="form-control" name="spek" placeholder="Spesifikasi..." value="" required autofocus></textarea>
            </div>
        </div>
        <div class="row mb-3" id="group_status" style="display:none">
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
        <div class="row mb-3" id="group_jumlah">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Jumlah Barang</label>
            <div class="col-md-6">
                <input id="total_stok" type="number" class="form-control" name="total_stok" placeholder="10" value="" required autofocus>
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="btnSaveBarang"  class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
