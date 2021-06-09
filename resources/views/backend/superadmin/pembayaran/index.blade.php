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
                    <span class="m-0 font-weight-bold text-primary">Data Pembayaran</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.pembayaran.add') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <div class="table-responsive">
                  <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Pemesanan</th>
                        <th>Total Bayar</th>
                        <th>Tgl Pembayaran</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pembayarans as $pembayaran)
                        <tr>
                          <td>{{ $pembayaran->id_pembayaran }}</td>
                          <td>{{ $pembayaran->pemesanan->id_pemesanan }}-{{ $pembayaran->pemesanan->pelanggan->nama }}</td>
                          <td>@rupiah($pembayaran->total_bayar)</td>
                          <td>{{ $pembayaran->pemesanan->id_status > 3 ? $pembayaran->tgl_pembayaran : '-' }}</td>
                          <td>
                            <a href="{{ route('backend.superadmin.pembayaran.edit', ['id' => $pembayaran->id_pembayaran]) }}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{ route('backend.superadmin.pembayaran.delete', ['id' => $pembayaran->id_pembayaran]) }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
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