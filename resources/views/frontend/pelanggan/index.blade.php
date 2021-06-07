@extends('frontend.index_home')
@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row my-md-4 pt-5 justify-content-center">
          <div class="col">
            <h1 class="h3 text-gray-800 font-weight-bold text-center">Selamat Datang, <br class="d-lg-none"> {{ $pelanggans->nama }}</h1>
            <hr>
            <div class="row">
              <div class="col-12 col-lg-6 col-xl-4 my-2 px-4 px-lg-3">
                <a href="#" class="text-decoration-none">
                  <div class="card border-left-primary py-1">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col mr-2">
                          <div class="h5 font-weight-bold text-primary text-uppercase m-0">
                            Pesan Makanan
                          </div>
                          <small>Lanjutkan pemesanan</small>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-arrow-right fa-2x text-gray-400"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2 px-4 px-lg-3">
                <a href="#" class="text-decoration-none">
                  <div class="card border-left-info py-1">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col mr-2">
                          <div class="h5 font-weight-bold text-info text-uppercase m-0">
                            Lihat Pesanan
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-concierge-bell fa-2x text-gray-400"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-12 col-lg-6 col-xl-4 my-2 px-4 px-lg-3">
                <a href="{{ route('home.pelanggan.logout') }}" class="text-decoration-none">
                  <div class="card border-left-danger py-1">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col mr-2">
                          <div class="h5 font-weight-bold text-danger text-uppercase m-0">
                            Keluar
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-sign-out-alt fa-2x text-gray-400"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection