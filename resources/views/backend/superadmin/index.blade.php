@extends('backend.index')
@section('main-content-page')
  <div id="main_content" style="display: none;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Admin Panel - {{ $user->nama }}</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-12 col-lg-6 col-xl-4 my-1">
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
                        2 User Terdaftar
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
              <div class="col-12 col-lg-6 col-xl-4 my-1">
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
                        4 Menu Aktif
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
              <div class="col-12 col-lg-6 col-xl-4 my-1">
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
                        2 Kategori Aktif
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
              <div class="col-12 col-lg-6 col-xl-4 my-1">
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
                        4 Pelanggan Aktif
                      </div>
                      <div class="col">
                        <div class="text-right">
                          <a href="#" class="btn btn-success btn-sm">
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