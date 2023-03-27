<div class="col-md-12">
                    <form method="POST" id="formUser">
                        @csrf

                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6" hidden disabled>
                                <input id="id" type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

                            <div class="col-md-6">
                                <input id="old_username" type="username" class="form-control" name="old_username" hidden>
                                <input id="username" type="username" class="form-control" name="username"  required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Level</label>
                            <div class="col-md-6">
                                <select class="form-select" id="level" name="level">
                                    <option value="1">Admin</option>
                                    <option value="2">Ketua RT</option>
                                    <option value="3">Sekretaris</option>
                                    <option value="4">Penanggung Jawab</option>
                                    <option value="5">Warga</option>
                                </select>
                            </div>
                        </div>
                        <div id="group_createat" class="row mb-3" style="display:none">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">create_at</label>
                            <div class="col-md-6">
                                <input id="create_at" type="text" class="form-control " name="create_at" disabled readonly>
                            </div>
                        </div>
                        <div id="group_lastlogin" class="row mb-3" style="display:none">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">last login</label>
                            <div class="col-md-6">
                                <input id="last_login" type="text" class="form-control" name="last_login" disabled readonly>
                            </div>
                        </div>
                        <div class="row mb-3" id="group_password">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3" id="group_confirmpassword">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btnSaveUser" type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <button id="btnEditUser" type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
