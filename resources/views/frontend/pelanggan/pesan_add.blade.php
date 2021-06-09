@extends('frontend.index_home')

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row my-md-4 pt-5 justify-content-center">
          <div class="col-12 p-4">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center pb-3 p-lg-0">
                    <img src="{{ asset($menus->img) }}" alt="{{ $menus->menu }}" class="img-fluid shadow rounded" width="300">
                  </div>
                  <div class="col-lg-6">
                    <h1 class="h3 font-weight-bold">{{ $menus->menu }}</h1>
                    <p>{{ $menus->deskripsi }}</p>
                    <p>Kategori : {{ $menus->kategori->kategori }}</p>
                    <p class="h4 font-weight-bold">@rupiah($menus->harga)</p>
                    <hr>
                    <form action="{{ route('home.pelanggan.pesan.add.do', ['id' => $menus->id_menu]) }}" method="POST">
                      {{ csrf_field() }}
                      <div class="form-row">
                        <div class="form-group col-6 col-lg-4 m-0">
                          <input type="number" class="form-control form-control-sm @error('kuantitas') is-invalid @enderror" name="kuantitas" id="kuantitas" placeholder="Kuantitas" value="{{ isset($detail) ? $detail->first()->kuantitas : old('kuantitas') }}">
                          @error('kuantitas')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group col-4 col-lg-4 m-0">
                          <button type="submit" class="btn btn-primary btn-sm btn-block">Simpan</button>
                        </div>
                        <div class="form-group col-2 col-lg-4 m-0">
                          @if (isset($detail))
                            <a href="{{ route('home.pelanggan.pesan.delete.do', ['id' => $menus->id_menu]) }}" class="btn btn-danger btn-sm btn-block"><i class="fas fa-times"></i></a>
                          @endif
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row align-items-center justify-content-center">
                  <div class="col-4">
                    <a href="{{ (url()->previous() == url()->current()) ? route('home.pelanggan.pesan') : url()->previous() }}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Batal</a>
                  </div>
                  <div class="col-8 col-lg-2 ml-auto text-center">
                    @if (session('message'))
                      <div class="alert alert-{{ Session::get('message-class', 'warning') }} p-1 m-0" role="alert">
                        {{ session('message') }}
                      </div>
                    @endif
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