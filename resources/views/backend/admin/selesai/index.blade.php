@extends('backend.index')

@section('top-assets-page')
  <meta http-equiv="refresh" content="30">
@endsection

@section('main-content-page')
  <div id="main_content" style="display: none;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 mt-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Selesai</h1>
            <p class="m-0">Selesaikan pesanan</p class="m-0">
          </div>
          <div class="col-12">
            @if (session('message'))
              <div class="alert alert-{{ Session::get('message-class', 'warning') }} my-2 p-1 text-center" role="alert">
                {{ session('message') }}
              </div>
            @else
              <div class="alert alert-info my-2 p-1 text-center" role="alert">
                Halaman diperbarui setiap 30 detik, terakhir diperbarui {{ date('H:i') }}
              </div>
            @endif
            <hr>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-12 text-center">
                <a href="{{ route('backend.admin.bayar') }}" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-wave-alt"></i> Pembayaran</a>
                <a href="{{ route('backend.admin.proses') }}" class="btn btn-info btn-sm"><i class="fas fa-sync-alt"></i> Proses</a>
                <a href="{{ route('backend.admin.selesai') }}" class="btn btn-success btn-sm disabled"><i class="fas fa-check"></i> Selesai</a>
              </div>
              @forelse ($pemesanans as $pemesanan)
                <div class="col-12 col-lg-6 col-xl-4 mt-3">
                  <div class="card shadow-sm h-100">
                    <div class="card-body">
                      <b>ID Pesanan:</b> {{ $pemesanan->id_pemesanan }} <br>
                      <b>Nama Pelanggan:</b> {{ $pemesanan->pelanggan->nama }} <br>
                      <b>Tgl Pesanan:</b> {{ $pemesanan->tgl_pemesanan }} <br>
                      <b>Pesanan:</b>
                      <ul class="m-0">
                        @php $count_kuantitas = 0 @endphp
                        @foreach ($details->where('id_pemesanan', $pemesanan->id_pemesanan) as $detail)
                          @php $count_kuantitas += $detail->kuantitas @endphp
                          <li>{{ $detail->menu->menu }} (x{{ $detail->kuantitas }})</li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="card-footer text-muted">
                      <div class="row align-items-center">
                        <div class="col-5 font-weight-bold">
                          Stat: Diproses
                        </div>
                        <div class="col-7">
                          <div class="text-right">
                            <a href="{{ route('backend.admin.selesai.do', ['id' => $pemesanan->id_pemesanan]) }}" class="btn btn-success btn-sm">
                              Selesaikan Pesanan
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12 text-center text-gray-600 my-2">
                  Tidak ada pesanan yang perlu diselesaikan
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection