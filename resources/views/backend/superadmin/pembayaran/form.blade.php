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
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen Pembayaran</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">{{ isset($pembayarans) ? 'Edit' : 'Tambah' }} Pembayaran</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.pembayaran') }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ isset($pembayarans) ? route('backend.superadmin.pembayaran.edit.do', ['id' => $pembayarans->id_pembayaran]) : route('backend.superadmin.pembayaran.add.do') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="id_pemesanan">Pemesanan <span class="text-danger">*</span></label>
                      <select class="custom-select @error('id_pemesanan') is-invalid @enderror" name="id_pemesanan" id="id_pemesanan">
                        <option {{ isset($pembayarans) ? '' : 'selected' }} disabled>Pilih pemesanan</option>
                        @foreach ($pemesanans as $pemesanan)
                          <option value="{{ $pemesanan->id_pemesanan }}" {{ isset($pembayarans) && $pembayarans->id_pemesanan == $pemesanan->id_pemesanan ? 'selected' : (old('id_pemesanan') == $pemesanan->id_pemesanan ? 'selected' : '') }}>{{ $pemesanan->id_pemesanan }} - {{ $pemesanan->pelanggan->nama }}</option>
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
                      <label for="total_bayar">Total Bayar <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('total_bayar') is-invalid @enderror" name="total_bayar" id="total_bayar" placeholder="Total pembayaran" value="{{ isset($pembayarans) ? $pembayarans->total_bayar : old('total_bayar') }}">
                      @error('total_bayar')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="tgl_pembayaran">Taggal Pembayaran <span class="text-danger">*</span></label>
                      <input type="datetime-local" class="form-control @error('tgl_pembayaran') is-invalid @enderror" name="tgl_pembayaran" id="tgl_pembayaran" placeholder="Taggal pembayaran" value="{{ isset($pembayarans) ? date('Y-m-d\TH:i', strtotime($pembayarans->tgl_pembayaran)) : old('tgl_pembayaran') }}">
                      @error('tgl_pembayaran')
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