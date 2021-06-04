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
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen Detail Pemesanan</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">{{ isset($details) ? 'Edit' : 'Tambah' }} Detail Pemesanan</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.detail') }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ isset($details) ? route('backend.superadmin.detail.edit.do', ['id' => $details->id_pemesanan_detail]) : route('backend.superadmin.detail.add.do') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="id_pemesanan">Pemesanan <span class="text-danger">*</span></label>
                      <select class="custom-select @error('id_pemesanan') is-invalid @enderror" name="id_pemesanan" id="id_pemesanan">
                        <option {{ isset($details) ? '' : 'selected' }} disabled>Pilih pemesanan</option>
                        @foreach ($pemesanans as $pemesanan)
                          <option value="{{ $pemesanan->id_pemesanan }}" {{ isset($details) && $details->id_pemesanan == $pemesanan->id_pemesanan ? 'selected' : (old('id_pemesanan') == $pemesanan->id_pemesanan ? 'selected' : '') }}>{{ $pemesanan->id_pemesanan }} - {{ $pemesanan->pelanggan->nama }}</option>
                        @endforeach
                      </select>
                      @error('id_pemesanan')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="id_menu">Menu Makanan <span class="text-danger">*</span></label>
                      <select class="custom-select @error('id_menu') is-invalid @enderror" name="id_menu" id="id_menu">
                        <option {{ isset($details) ? '' : 'selected' }} disabled>Pilih menu makanan</option>
                        @foreach ($menus as $menu)
                          <option value="{{ $menu->id_menu }}" {{ isset($details) && $details->id_menu == $menu->id_menu ? 'selected' : (old('id_menu') == $menu->id_menu ? 'selected' : '') }}>{{ $menu->menu }}</option>
                        @endforeach
                      </select>
                      @error('id_menu')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="kuantitas">Kuantitas <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('kuantitas') is-invalid @enderror" name="kuantitas" id="kuantitas" placeholder="Jumlah kuantitas" value="{{ isset($details) ? $details->kuantitas : old('kuantitas') }}">
                      @error('kuantitas')
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