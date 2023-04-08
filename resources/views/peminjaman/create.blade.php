<div class="col-md-12">
    <form id="formPeminjaman" name="formPeminjaman" class="form">
        @csrf
        <div class="row mb-3" id="group_nama_peminjam">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Peminjam</label>
            <div class="col-md-6">
                <input id="param" name="param" type="hidden" class="form-control" value="peminjaman">
                <input id="id_peminjaman" name="id_peminjaman" type="hidden" class="form-control">
                <select class="form-control form-select select2" name="nama_peminjam" id="nama_peminjam" placeholder="pilih nama peminjam">
                    <option selected disabled>Pilih nama peminjam</option>
                @foreach($data_peminjam as $warga)
                    <option value="{{$warga->id}}">{{$warga->nama_lengkap}}</option>
                @endforeach
                </select>
                <input id="id_peminjam" name="id_peminjam" type="hidden" class="form-control">
            </div>
        </div>
        <div class="row mb-3" id="group_nama">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Barang</label>
            <div class="col-md-6">
                <select class="form-control form-select select2" name="nama_barang_peminjaman" id="nama_barang_peminjaman" placeholder="pilih nama barang">
                    <option selected disabled>Pilih nama barang</option>
                @foreach($data_barang as $barang)
                    <option value="{{$barang->id}}">{{$barang->nama}}</option>
                @endforeach
                </select>
                <input id="id_barang_peminjaman" name="id_barang_peminjaman" type="hidden" class="form-control">
            </div>
        </div>
        <div class="row mb-3" id="group_jumlah">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Jumlah barang</label>
            <div class="col-md-6 input-icon">
                <input class="form-control " placeholder="jumlah barang" name="jumlah_peminjaman" id="jumlah_peminjaman" type="number">
                <input id="jml_peminjaman" name="jml_peminjaman" type="hidden" class="form-control">
            </div>
        </div>
        <div class="row mb-3" id="group_tanggal_pinjam">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Tanggal pinjam</label>
            <div class="col-md-6 input-icon">
                <input class="form-control " placeholder="tanggal peminjaman" name="tgl_peminjaman" id="tgl_peminjaman" type="date">
            </div>
        </div>
        <div class="row mb-3" id="group_tanggal_kembali">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Tanggal kembali</label>
            <div class="col-md-6 input-icon">
                <input class="form-control " placeholder="tanggal kembali" name="tgl_kembali" id="tgl_kembali" type="date">
            </div>
        </div>
        <div class="row mb-3" id="group_status">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Status peminjaman</label>
            <div class="col-md-6 input-icon">
                <select name="status_peminjaman" class="form-control form-select" id="status_peminjaman">
                    <option value="0" selected>Belum Diambil</option>
                    <option value="1">Sudah Diambil</option>
                    <option value="2">Sudah Dikembalikan</option>
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
