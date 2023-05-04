@extends('global.default')
@section('title', 'Dashboard')
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
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Pengajuan Surat Domisili</h3>
                    <div class="mb-2">   
                        Syarat dan Ketentuan:
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-checkbox"></i>
                      <strong>Fotocopy KTP</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-checkbox"></i>
                      <strong>Fotocopy KTM(Untuk Mahasiswa)</strong>
                    </div>
                    <div class="mb-3">
                      <i class="ti ti-checkbox"></i>
                      <strong>Surat Kampus(Untuk Mahasiswa)</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-asterisk"></i>
                      <strong>Jika persyaratan sudah lengkap dapat menghubungi Pak Yudi</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-phone"></i>
                      <strong>082345678928</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-home"></i>
                      <strong>JL. Turus Asri III C/06</strong>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Pengajuan Peminjaman Barang</h3>
                    <div class="mb-2">
                      Syarat dan Ketentuan:
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-checkbox"></i>
                      <strong>Barang yang bisa dipinjam memiliki status "Tersedia"</strong>
                    </div>
                    <div class="mb-3">
                      <i class="ti ti-checkbox"></i>
                      <strong>Waktu Peminjaman barang maksimal 7 hari</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-asterisk"></i>
                      <strong>Jika ingin melakukan peminjaman barang silahkan Hubungi Pak Rosyid (Ketua RT)</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-phone"></i>
                      <strong>082345678928</strong>
                    </div>
                    <div class="mb-2">
                      <i class="ti ti-home"></i>
                      <strong>JL. Turus Asri III C/06</strong>
                    </div>
                  </div>
                </div>
              </div>
          </div>
            <!-- <div class="row row-deck row-cards">
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Warga Tetap</div>
                    </div>
                    <div class="h1 mb-3">75%</div>
                    <div class="d-flex mb-2">
                      <div>Pengisian data</div>
                      <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                          75% 
                        </span>
                      </div>
                    </div>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                        <span class="visually-hidden">75% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Penghuni Kos</div>
                    </div>
                    <div class="h1 mb-3">15%</div>
                    <div class="d-flex mb-2">
                      <div>Pengisian data</div>
                      <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                          90% 
                        </span>
                      </div>
                    </div>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 90%" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" aria-label="90% Complete">
                        <span class="visually-hidden">90% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Penghuni Kontrak</div>
                    </div>
                    <div class="h1 mb-3">10%</div>
                    <div class="d-flex mb-2">
                      <div>Pengisian data</div>
                      <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                          90% 
                        </span>
                      </div>
                    </div>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 90%" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" aria-label="90% Complete">
                        <span class="visually-hidden">90% Complete</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Data penduduk</h3>
                    <div id="chart-penduduk" class="chart-lg"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Peminjaman barang</h3>
                    <div class="ratio ratio-21x9">
                      <div>
                        <div id="chart-barang" class="w-100 h-100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
          </div>
        </div>
@endsection