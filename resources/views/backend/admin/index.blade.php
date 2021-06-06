@extends('backend.index')
@section('main-content-page')
  <div id="main_content" style="display: none;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 mt-md-4 text-center">
            <h1 class="h3 text-gray-800 font-weight-bold">Staff Panel - {{ $user->nama }}</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col text-center">
                <a href="{{ route('backend.admin.bayar') }}" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-wave-alt"></i> Pembayaran</a>
                <a href="{{ route('backend.admin.proses') }}" class="btn btn-info btn-sm"><i class="fas fa-sync-alt"></i> Proses</a>
                <a href="{{ route('backend.admin.selesai') }}" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Selesai</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection