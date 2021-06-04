@extends('backend.index')

@section('top-assets-page')
  <!-- Custom styles for data tables page -->
  <link href="{{ asset('assets/frontend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">

  <!-- Page data tables level plugins -->
  <script src="{{ asset('assets/frontend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/datatables/dataTables.bootstrap4.min.') }}js"></script>
  <script src="{{ asset('assets/frontend/vendor/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>
@endsection

@section('main-content-page')
  <div id="main_content" style="visibility: hidden;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen Menu</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">{{ isset($menus) ? 'Edit' : 'Tambah' }} Menu</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.menu') }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ isset($menus) ? route('backend.superadmin.menu.edit.do', ['id' => $menus->id_menu]) : route('backend.superadmin.menu.add.do') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="menu">Menu <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" id="menu" placeholder="Judul menu" value="{{ isset($menus) ? $menus->menu : old('menu') }}">
                      @error('menu')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-4">
                      <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                      <textarea class="form-control @error('menu') is-invalid @enderror" name="deskripsi" id="deskripsi" placeholder="Deskripsi lengkap ..." rows="3">{{ isset($menus) ? $menus->deskripsi : old('deskripsi') }}</textarea>
                      @error('deskripsi')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="harga">Harga <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" placeholder="Harga menu" value="{{ isset($menus) ? $menus->harga : old('harga') }}">
                      @error('harga')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="kategori">Kategori <span class="text-danger">*</span></label>
                      <select class="custom-select @error('kategori') is-invalid @enderror" name="kategori" id="kategori">
                        <option {{ isset($menus) ? '' : 'selected' }} disabled>Pilih kategori...</option>
                        @foreach ($kategoris as $kategori)
                          <option value="{{ $kategori->id_kategori }}" {{ isset($menus) && $menus->id_kategori == $kategori->id_kategori ? 'selected' : (old('kategori') == $kategori->id_kategori ? 'selected' : '') }}>{{ $kategori->kategori }}</option>
                        @endforeach
                      </select>
                      @error('kategori')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status-0" value="0" {{ (isset($menus) && $menus->status == 0) ? 'checked' : (old('status') == '0' ? 'checked' : '') }}>
                      <label class="form-check-label" for="status-0">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status-1" value="1" {{ (isset($menus) && $menus->status == 1) ? 'checked' : (old('status') == '1' ? 'checked' : '') }}>
                      <label class="form-check-label" for="status-1">Stok Habis</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status-2" value="2" {{ (isset($menus) && $menus->status == 2) ? 'checked' : (old('status') == '2' ? 'checked' : '') }}>
                      <label class="form-check-label" for="status-2">Tidak Tersedia</label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-12">
                      <label for="img">Gambar <span class="text-danger">{{ isset($menus) ? '' : '*' }}</span></label>
                      <input type="file" class="form-control-file @error('img') is-invalid @enderror" name="img" id="img">
                      <small class="form-text text-muted">
                        {{ isset($menus) ? 'Biarkan kosong jika tidak ingin mengubah gambar.' : '' }}
                      </small>
                      @error('img')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <small><span class="text-danger">*</span>) Diperlukan</small>
                  <hr>
                  <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('bottom-assets-page')
  <script src="{{ asset('assets/frontend/js/pages/datatables.js') }}"></script>
@endsection