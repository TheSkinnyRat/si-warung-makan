@extends('frontend.index')

@section('top-assets-page')
  <meta http-equiv="refresh" content="10">
@endsection

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Pembayaran</h1>
            <span class="small text-gray-800">Status pesanan ini akan diperbarui setiap 10 Detik.</span>
            <hr>
          </div>
          <div class="col col-lg-7">
            <div class="card shadow-sm mb-2">
              <div class="card-body">
                <div class="font-weight-bold">
                  ID Pemesanan: {{ $pemesanans->id_pemesanan }} <br>
                  Nama Pelanggan: {{ $pemesanans->pelanggan->nama }} <br>
                  Status: 
                  @if ($pemesanans->id_status == 3)
                    <span class="text-danger font-weight-bold">
                      Belum Dibayar
                    </span>
                  @elseif ($pemesanans->id_status == 4)
                    <span class="text-success font-weight-bold">
                      Sudah Dibayar
                    </span>
                  @endif
                </div>
                <hr>
                @php $count = 0  @endphp
                @foreach ($details as $detail)
                  @php $count += $detail->menu->harga*$detail->kuantitas @endphp
                  <div class="row align-items-center">
                    <div class="col-12">
                      <p class="font-weight-bold m-0">
                        {{ $detail->menu->menu }} [{{ $detail->kuantitas }}]
                      </p>
                      <p class="m-0 small">
                        @rupiah($detail->menu->harga) (x{{ $detail->kuantitas }}) = @rupiah($detail->menu->harga*$detail->kuantitas)
                      </p>
                    </div>
                  </div>
                  <hr>
                @endforeach
                <div class="text-primary small">
                  Harap <b>lakukan pembayaran (di kasir)</b> dengan menyebutkan <b>Nama</b> atau <b>ID Pemesanan</b>.
                </div>
              </div>
              <div class="card-footer text-muted">
                <div class="row align-items-center justify-content-center">
                  <div class="col font-weight-bold">
                    Total: @rupiah($count)
                  </div>
                  <div class="col">
                    <div class="text-right">
                      @if ($pemesanans->id_status == 4)
                        <a href="{{ route('home.pelanggan.riwayat.nota', ['id' => $pemesanans->id_pemesanan]) }}" class="btn btn-primary btn-sm">
                          Lihat Nota
                        </a>
                      @endif
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