@extends('frontend.index')

@section('main-content-page')
  <div id="main_content" style="visibility: hidden;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 my-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Nota Pesanan</h1>
            <a href="{{ route('home.pelanggan.riwayat') }}">Lihat riwayat</a>
            <hr>
          </div>
          <div class="col-lg-6">
            <div class="card shadow mb-4">
              <a href="#" class="card-header bg-info p-1 text-center text-white text-decoration-none font-weight-bold" onclick="print()">
                Print
              </a>
              <div class="card-body" id="toPrint">
                <div class="font-weight-bold text-dark">
                  Nota Pesanan - Si Warung Makan <br>
                </div>
                <hr>
                <b>ID Pemesanan:</b> <span class="text-right">{{ $pembayarans->pemesanan->id_pemesanan }}</span>  <br>
                <b>ID Pembayaran:</b> {{ $pembayarans->id_pembayaran }} <br>
                <b>ID Pelanggan:</b> {{ $pembayarans->pemesanan->id_pelanggan }} <br>
                <b>Nama Pelanggan:</b> {{ $pembayarans->pemesanan->pelanggan->nama }} <br>
                <b>Tanggal Pemesanan:</b> {{ date('d F Y H:i', strtotime($pembayarans->pemesanan->tgl_pemesanan)) }} <br>
                <b>Tanggal Pembayaran:</b> {{ date('d F Y H:i', strtotime($pembayarans->tgl_pembayaran)) }} <br>
                <b>Pesanan:</b>
                <ul>
                  @php $count_detail = 0 @endphp
                  @foreach ($details->where('id_pemesanan', $pembayarans->pemesanan->id_pemesanan) as $detail)
                    @php $count_detail += $detail->kuantitas @endphp
                    <li>{{ $detail->menu->menu }}: @rupiah($detail->menu->harga) (x{{ $detail->kuantitas }})</li>
                  @endforeach
                </ul>
                <small>Harga menu makanan mungkin dapat berubah sejak terakhir anda memesannya.</small>
                <hr>
                <b>Total Pemesanan: {{ $count_detail }}</b> <br>
                <b>Total Pembayaran: @rupiah($pembayarans->total_bayar)</b> <br>
                <b>Status: <span class="text-success">Sudah Dibayar</span></b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('bottom-assets-page')
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