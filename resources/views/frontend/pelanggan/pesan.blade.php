@extends('frontend.index_home')
@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row my-md-4 pt-5 justify-content-center">
          <div class="col">
            <h1 class="h3 text-gray-800 font-weight-bold text-center">{{ $pelanggans->nama }}, <br class="d-lg-none">Mau Pesan Apa?</h1>
            @if (session('message'))
              <div class="alert alert-{{ Session::get('message-class', 'warning') }} p-1 m-0 text-center" role="alert">
                {{ session('message') }}
              </div>
            @endif
            <hr>
            <div class="row justify-content-center">
              <div class="col-12 text-center mb-2">
                <div class="dropdown">
                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="btnKategori" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $kategori_name ?? 'Kategori' }}
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnKategori">
                    <a class="dropdown-item" href="{{ route('home.pelanggan.pesan') }}">Tampilkan Semua</a>
                    @foreach ($kategoris as $kategori)
                      <a class="dropdown-item" href="{{ route('home.pelanggan.pesan.kategori', ['id' => $kategori->id_kategori]) }}">{{ $kategori->kategori }}</a>
                    @endforeach
                  </div>
                  @if ($count['pesanan'] > 0)
                    <a href="{{ route('home.pelanggan.pesanan') }}" class="btn btn-success btn-sm">Lanjutkan <i class="fas fa-arrow-right"></i></a>
                  @endif
                </div>
              </div>
              @forelse ($menus as $menu)
                <div class="col-10 col-sm-6 col-md-4 col-lg-3 my-2">
                  <div class="card h-100 shadow-sm">
                    <img class="card-img-top" src="{{ asset($menu->img) }}" alt="{{ $menu->menu }}">
                    <div class="card-body text-center">
                      <h5 class="card-title">{{ $menu->menu }}</h5>
                      <hr>
                      <p class="card-text">{{ $menu->deskripsi }}</p>
                    </div>
                    <div class="card-footer">
                      <div class="text-muted">
                        <div class="row align-items-center">
                          <div class="col-6">
                            @rupiah($menu->harga)
                          </div>
                          <div class="col-6">
                            @if ($menu->status == 0)
                              @php $detail = $details->where('id_menu', $menu->id_menu)->first() @endphp
                              @if ($detail)
                                <a href="{{ route('home.pelanggan.pesan.add', ['id' => $menu->id_menu]) }}" class="btn btn-info btn-sm btn-block">({{ $detail->kuantitas }}) Ubah</a>
                              @else
                                <a href="{{ route('home.pelanggan.pesan.add', ['id' => $menu->id_menu]) }}" class="btn btn-success btn-sm btn-block">Pesan</a>
                              @endif
                            @elseif ($menu->status == 1)
                              <a href="#" class="btn btn-danger btn-sm btn-block disabled">Stok Habis</a>
                            @else
                              <a href="#" class="btn btn-danger btn-sm btn-block disabled">Tdk Trsdia</a>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="text-center">
                  Tidak ada menu yang tersedia
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection