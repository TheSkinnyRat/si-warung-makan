@extends('frontend.index')

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Checkout</h1>
            <hr>
          </div>
          <div class="col col-lg-7">
            <div class="card shadow-sm mb-2">
              <div class="card-body">
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
                  Harap <b>lakukan pembayaran (ke kasir)</b> setelah menekan tombol <b>"bayar"</b>.
                </div>
              </div>
              <div class="card-footer text-muted">
                <div class="row align-items-center justify-content-center">
                  <div class="col font-weight-bold">
                    Total: @rupiah($count)
                  </div>
                  <div class="col">
                    <div class="text-right">
                      <a href="{{ route('home.pelanggan.checkout.do', ['id' => $pemesanans->id_pemesanan]) }}" class="btn btn-primary btn-sm">
                        Bayar <i class="fas fa-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center my-4">
              <a href="{{ route('home.pelanggan.checkout.delete.do', ['id' => $pemesanans->id_pemesanan]) }}" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus Pesanan
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection