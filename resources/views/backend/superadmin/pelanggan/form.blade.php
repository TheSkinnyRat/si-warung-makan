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
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen Pelanggan</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">{{ isset($pelanggans) ? 'Edit' : 'Tambah' }} Pelanggan</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.pelanggan') }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ isset($pelanggans) ? route('backend.superadmin.pelanggan.edit.do', ['id' => $pelanggans->id_pelanggan]) : route('backend.superadmin.pelanggan.add.do') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="id_pelanggan">ID Pelanggan</label>
                      <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" placeholder="ID Pelanggan" value="AUTO GENERATED" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-4">
                      <label for="nama">Nama <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama pelanggan" value="{{ isset($pelanggans) ? $pelanggans->nama : old('nama') }}">
                      @error('nama')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-4">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email pelanggan" value="{{ isset($pelanggans) ? $pelanggans->email : old('email') }}">
                      @error('email')
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