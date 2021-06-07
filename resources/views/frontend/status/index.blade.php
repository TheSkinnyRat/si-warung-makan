@extends('frontend.index')

@section('top-assets-page')
  <meta http-equiv="refresh" content="30">
@endsection

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Status Pesanan Saat Ini</h1>
            <p class="m-0">Diperbarui setiap 30 detik, terakhir diperbarui {{ date('H:i') }}</p>
            <a href="{{ route('home') }}">Halaman Utama</a>
            <hr>
          </div>
          <div class="col col-lg-7">
            <div class="card shadow-sm">
              <div class="card-body">
                @forelse ($pemesanans as $pemesanan)
                  <div class="row align-items-center">
                    <div class="col-8 col-xl-9">
                      <p class="font-weight-bold m-0">
                        {{ $pemesanan->pelanggan->nama }}
                      </p>
                      <p class="m-0">
                        Dipesan pada: <br class="d-lg-none">
                        {{ date('d F Y H:i', strtotime($pemesanan->tgl_pemesanan)) }}
                      </p>
                    </div>
                    <div class="col-4 col-xl-3">
                      <p class="font-weight-bold m-0 text-center">
                        @if ($pemesanan->id_status == 4)
                          <span class="text-secondary">Antri</span>
                        @else
                          <span class="text-info">Diproses</span>
                        @endif
                      </p>
                    </div>
                  </div>
                  <hr>
                @empty
                  <div class="text-center">
                    Tidak ada pesanan saat ini
                  </div>
                  <hr>
                @endforelse
                <small class="font-weight-bold text-gray-600">Pesanan yang <span class="text-dark">belum dibayar</span>, <span class="text-success">sudah selesai</span>, atau <span class="text-danger">dibatalkan</span> tidak ditampilkan.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection