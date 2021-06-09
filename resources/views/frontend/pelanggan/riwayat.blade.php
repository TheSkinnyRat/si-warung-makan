@extends('frontend.index')

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
            <h1 class="h3 text-gray-800 font-weight-bold">Riwayat Pesanan</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-12">
                    <span class="m-0 font-weight-bold text-primary">Riwayat Pesanan {{ $pelanggans->nama }}</span>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tgl Pemesanan</th>
                        <th>Detail</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pemesanans as $pemesanan)
                        <tr>
                          <td>{{ $pemesanan->id_pemesanan }}</td>
                          <td>{{ date('d M Y H:i:s', strtotime($pemesanan->tgl_pemesanan)) }}</td>
                          <td>
                            @forelse ($details->where('id_pemesanan', $pemesanan->id_pemesanan) as $detail)
                              {{ $detail->menu->menu }}: {{ $detail->kuantitas }} <br>
                            @empty
                              -
                            @endforelse
                          </td>
                          <td>
                            @if ($pembayarans->where('id_pemesanan', $pemesanan->id_pemesanan)->first())
                              @rupiah($pembayarans->where('id_pemesanan', $pemesanan->id_pemesanan)->first()->total_bayar)
                            @else
                              -
                            @endif
                          </td>
                          <td>{{ $pemesanan->status->status }}</td>
                          <td class="text-center">
                            @if ($pemesanan->id_status > 3 && $pemesanan->id_status != 7)
                              <a href="{{ route('home.pelanggan.riwayat.nota', ['id' => $pemesanan->id_pemesanan]) }}" class="btn btn-info btn-sm">Lihat Nota</a>
                            @elseif ($pemesanan->id_status == 2)
                              <a href="{{ route('home.pelanggan.checkout', ['id' => $pemesanan->id_pemesanan]) }}" class="btn btn-primary btn-sm">Bayar</a>
                            @elseif ($pemesanan->id_status == 3)
                              <a href="{{ route('home.pelanggan.bayar', ['id' => $pemesanan->id_pemesanan]) }}" class="btn btn-primary btn-sm">Lihat</a>
                            @else
                              -
                            @endif
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