<div class="col-md-12">
    <form id="formBarang" name="formBarang" class="form">
        @csrf
        <div class="row mb-3" id="group_nama_peminjam">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Peminjam</label>
            <div class="col-md-6">
                  <select class="form-select select2" name="nama_peminjam" id="nama_peminjam" placeholder="pilih nama peminjam">
                        <option selected disabled>Pilih nama peminjam</option>
                    @foreach($data_peminjam as $warga)
                        <option value="{{$warga->id}}">{{$warga->nama_lengkap}}</option>
                    @endforeach
                  </select>
            </div>
        </div>
        <div class="row mb-3" id="group_nama">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama Barang</label>
            <div class="col-md-6">
                <select class="form-select select2" name="nama_barang" id="nama_barang" placeholder="pilih nama barang">
                    <option selected disabled>Pilih nama barang</option>
                @foreach($data_barang as $barang)
                    <option value="{{$barang->id}}">{{$barang->nama}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3" id="group_jumlah">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Jumlah barang</label>
            <div class="col-md-6 input-icon">
                <input class="form-control " placeholder="jumlah barang" id="jumlah" type="number">
            </div>
        </div>
        <div class="row mb-3" id="group_tanggal_pinjam">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Tanggal pinjam</label>
            <div class="col-md-6 input-icon">
                <input class="form-control " placeholder="tanggal peminjaman" id="tgl_pinjam" type="date">
            </div>
        </div>
        <div class="row mb-3" id="group_tanggal_kembali">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Tanggal kembali</label>
            <div class="col-md-6 input-icon">
                <input class="form-control " placeholder="tanggal kembali" id="tgl_kembali" type="date">
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
