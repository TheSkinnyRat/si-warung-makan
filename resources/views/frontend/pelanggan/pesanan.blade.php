@extends('frontend.index')

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Pesanan Anda</h1>
            <a href="{{ url()->previous() == url()->current() ? route('home.pelanggan.pesan') : url()->previous() }}">Kembali</a>
            <hr>
          </div>
          <div class="col col-lg-7">
            <div class="card shadow-sm mb-2">
              <div class="card-body">
                @php $count = 0  @endphp
                @forelse ($details as $detail)
                  @php $count += $detail->menu->harga*$detail->kuantitas @endphp
                  <div class="row align-items-center">
                    <div class="col-8 col-xl-9">
                      <p class="font-weight-bold m-0">
                        {{ $detail->menu->menu }} [{{ $detail->kuantitas }}]
                      </p>
                      <p class="m-0 small">
                        @rupiah($detail->menu->harga) (x{{ $detail->kuantitas }}) = @rupiah($detail->menu->harga*$detail->kuantitas)
                      </p>
                    </div>
                    <div class="col-4 col-xl-3 text-right">
                      <a href="{{ route('home.pelanggan.pesan.add', ['id' => $detail->menu->id_menu]) }}" class="btn btn-info btn-sm">
                        <i class="far fa-edit"></i>
                      </a>
                      <a href="{{ route('home.pelanggan.pesan.delete.do', ['id' => $detail->menu->id_menu]) }}" class="btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i>
                      </a>
                    </div>
                  </div>
                  <hr>
                @empty
                  <div class="text-center">
                    Tidak ada pesanan. <a href="{{ route('home.pelanggan.pesan') }}">Tambah sekarang!</a>
                  </div>
                @endforelse
                @if ($details->isNotEmpty())
                  <div class="text-danger small">
                    Anda tidak dapat mengubah pesanan setelah checkout.
                  </div>
                @endif
              </div>
              <div class="card-footer text-muted">
                <div class="row align-items-center justify-content-center">
                  <div class="col font-weight-bold">
                    Total: @rupiah($count)
                  </div>
                  <div class="col">
                    <div class="text-right">
                      @if ($details->isNotEmpty())
                        <a href="{{ route('home.pelanggan.pesanan.do') }}" class="btn btn-success btn-sm">
                          Checkout <i class="fas fa-arrow-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center my-4">
              <a href="{{ route('home.pelanggan.pesanan.delete.do') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus Pesanan
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection