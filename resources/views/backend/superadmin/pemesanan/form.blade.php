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
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen Pemesanan</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">{{ isset($pemesanans) ? 'Edit' : 'Tambah' }} Pemesanan</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.pemesanan') }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ isset($pemesanans) ? route('backend.superadmin.pemesanan.edit.do', ['id' => $pemesanans->id_pemesanan]) : route('backend.superadmin.pemesanan.add.do') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="id_pelanggan">Pelanggan <span class="text-danger">*</span></label>
                      <select class="custom-select @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan" id="id_pelanggan">
                        <option {{ isset($pemesanans) ? '' : 'selected' }} disabled>Pilih pelanggan</option>
                        @foreach ($pelanggans as $pelanggan)
                          <option value="{{ $pelanggan->id_pelanggan }}" {{ isset($pemesanans) && $pemesanans->id_pelanggan == $pelanggan->id_pelanggan ? 'selected' : (old('id_pelanggan') == $pelanggan->id_pelanggan ? 'selected' : '') }}>{{ $pelanggan->nama }}</option>
                        @endforeach
                      </select>
                      @error('id_pelanggan')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="tgl_pemesanan">Taggal Pemesanan <span class="text-danger">*</span></label>
                      <input type="datetime-local" class="form-control @error('tgl_pemesanan') is-invalid @enderror" name="tgl_pemesanan" id="tgl_pemesanan" placeholder="Taggal pemesanan" value="{{ isset($pemesanans) ? date('Y-m-d\TH:i', strtotime($pemesanans->tgl_pemesanan)) : old('tgl_pemesanan') }}">
                      @error('tgl_pemesanan')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="id_status">Status <span class="text-danger">*</span></label>
                      <select class="custom-select @error('id_status') is-invalid @enderror" name="id_status" id="id_status">
                        <option {{ isset($pemesanans) ? '' : 'selected' }} disabled>Pilih status</option>
                        @foreach ($statuses as $status)
                          <option value="{{ $status->id_status }}" {{ isset($pemesanans) && $pemesanans->id_status == $status->id_status ? 'selected' : (old('id_status') == $status->id_status ? 'selected' : '') }}>{{ $status->id_status }} - {{ $status->status }}</option>
                        @endforeach
                      </select>
                      @error('id_status')
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