@extends('backend.index')
@section('main-content-page')
  <div id="main_content" style="display: none;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Owner Panel - {{ $user->nama }}</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-users fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data User
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['users'] }} User
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.user') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-hamburger fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Menu Makanan
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['menus'] }} Menu
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.menu') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-folder-open fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Menu Kategori
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['kategoris'] }} Kategori
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.kategori') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-user fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Pelanggan
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['pelanggans'] }} Pelanggan
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.pelanggan') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-list-alt fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Status List
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['statuses'] }} Status List
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.status') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-book fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Pemesanan
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['pemesanans'] }} Pemesanan
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.pemesanan') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-book-medical fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Detail Pemesanan
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['details'] }} Detail
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.detail') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-money-check-alt fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Data Pembayaran
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        {{ $count['pembayarans'] }} Pembayaran
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.pembayaran') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <i class="fas fa-clipboard-list fa-4x"></i>
                      </div>
                      <div class="col">
                        <h3 class="h3">
                          Laporan
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <div class="row">
                      <div class="col">
                        Generate Laporan
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="{{ route('backend.superadmin.laporan') }}" class="btn btn-success btn-sm">
                            Lihat Data
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection