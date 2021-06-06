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
        <div class="row align-items-center justify-content-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Generate Laporan</h1>
            <hr>
          </div>
          <div class="col-lg-6">
            <div class="card shadow mb-4">
              <a href="#" class="card-header bg-info p-1 text-center text-white text-decoration-none font-weight-bold" onclick="print();">
                Print
              </a>
              <div class="card-body" id="toPrint">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <div class="font-weight-bold text-dark">
                  Laporan Penjualan - Si Warung Makan <br>
                  Tanggal Awal: {{ date('d F Y', strtotime($request->tgl_awal)) }} <br>
                  Tanggal Akhir: {{ date('d F Y', strtotime($request->tgl_akhir)) }} <br>
                </div>
                <hr>
                @php $count = 0 @endphp
                @foreach ($pembayarans as $pembayaran)
                  @php $count += $pembayaran->total_bayar @endphp
                  <b>ID Pemesanan:</b> <span class="text-right">{{ $pembayaran->pemesanan->id_pemesanan }}</span>  <br>
                  <b>ID Pelanggan:</b> {{ $pembayaran->pemesanan->id_pelanggan }} <br>
                  <b>Nama Pelanggan:</b> {{ $pembayaran->pemesanan->pelanggan->nama }} <br>
                  <b>Tanggal Pembayaran:</b> {{ date('d F Y H:i', strtotime($pembayaran->tgl_pembayaran)) }} <br>
                  <b>Total Pembayaran:</b> @rupiah($pembayaran->total_bayar) <br>
                  <b>Pesanan:</b>
                  <ul>
                    @foreach ($details->where('id_pemesanan', $pembayaran->pemesanan->id_pemesanan) as $detail)
                      <li>{{ $detail->menu->menu }}: x{{ $detail->kuantitas }}</li>
                    @endforeach
                  </ul>
                  <hr>
                @endforeach
                <b>Total Pemesanan: {{ count($pembayarans) }}</b> <br>
                <b>Total Pembayaran: @rupiah($count)</b>
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
  <script>
    function print() {
      var toPrint=document.getElementById('toPrint');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<html><body onload="window.print()">'+toPrint.innerHTML+'</body></html>');
      newWin.document.close();
      setTimeout(function(){newWin.close();},0);
    }
  </script>
@endsection