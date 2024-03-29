<div class="col-md-12">
    <form id="formUser" name="formUser" class="form">
        @csrf
        <div class="row mb-3" id="group_nama">
            <label for="nama" class="col-md-4 col-form-label text-md-end">Nama</label>
            <div class="col-md-6">
                <input id="id_user" name="id_user" type="hidden" class="form-control" value="">
                <input id="nama" type="text" class="form-control" name="nama" value="" required autofocus>
            </div>
        </div>

        <div class="row mb-3" id="group_username">
            <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

            <div class="col-md-6">
                <input id="old_username" type="username" class="form-control" name="old_username" value="" hidden>
                <input id="username" type="username" class="form-control" name="username"  value="" required>
            </div>
        </div>
        <div class="row mb-3" id="group_warga">
            <label for="namawarga" class="col-md-4 col-form-label text-md-end">Nama Warga</label>

            <div class="col-md-6">
                <select class="form-control form-select select2" name="nama_warga" id="nama_warga" placeholder="Nama Warga">
                    <option selected disabled>Nama Warga</option>
                    @foreach($data_warga as $warga)
                    <option value="{{$warga->id}}">{{$warga->nama_lengkap}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3" id="group_level">
            <label class="col-md-4 col-form-label text-md-end">Level</label>
            <div class="col-md-6">
                <select class="form-select" id="level" name="level">
                    <option value="Admin">Admin</option>
                    <option value="Ketua RT">Ketua RT</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="PJ">Penanggung Jawab</option>
                    <option value="User" selected>User</option>
                </select>
            </div>
        </div>
        <div id="group_createat" class="row mb-3" style="display:none">
            <label for="nama" class="col-md-4 col-form-label text-md-end">create_at</label>
            <div class="col-md-6">
                <input id="create_at" type="text" class="form-control " name="create_at" value="" disabled readonly>
            </div>
        </div>
        <div id="group_lastlogin" class="row mb-3" style="display:none">
            <label for="nama" class="col-md-4 col-form-label text-md-end">last login</label>
            <div class="col-md-6">
                <input id="last_login" type="text" class="form-control" name="last_login" value="" disabled readonly>
            </div>
        </div>
        <div class="row mb-3" id="group_password">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row mb-3" id="group_confirmpassword">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" value="" name="password_confirmation" autocomplete="new-password">
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="btnSaveUser" value="create" class="btn btn-primary">
                    Simpan
                </button>
                <button id="btnEditUser" value="store" class="btn btn-primary">
                    Simpan
                </button>
                <button id="btnChangePass" value="change" class="btn btn-primary">
                    Ubah Password
                </button>
            </div>
        </div>
    </form>
</div>
