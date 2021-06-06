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
            <h1 class="h3 text-gray-800 font-weight-bold">Generate Laporan</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ route('backend.superadmin.laporan.generate.do') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="tgl_awal">Pilih Tanggal Awal <span class="text-danger">*</span></label>
                      <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror" name="tgl_awal" id="tgl_awal" placeholder="Tanggal awal" value="{{ old('tgl_awal') }}">
                      @error('tgl_awal')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="tgl_akhir">Pilih Tanggal Akhir <span class="text-danger">*</span></label>
                      <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror" name="tgl_akhir" id="tgl_akhir" placeholder="Tanggal akhir" value="{{ old('tgl_akhir') }}">
                      @error('tgl_akhir')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <small><span class="text-danger">*</span>) Diperlukan</small>
                  <hr>
                  <button type="submit" class="btn btn-primary btn-sm">Generate</button>
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