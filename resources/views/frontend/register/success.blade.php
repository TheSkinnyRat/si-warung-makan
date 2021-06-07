@extends('frontend.index')

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="card shadow-sm my-5">
              <div class="card-body">
                <h3 class="h3 text-center">
                  ID Pelanggan Anda Adalah :
                </h3>
                <hr>
                <div class="bg-gray-200 p-5 my-3">
                  <h2 class="h2 text-center text-dark font-weight-bold m-0">
                    {{ $id_pelanggan }}
                  </h2>
                </div>
                <hr>
                <p class="text-center text-danger">
                  Harap catat dan simpan nomor ID Pelanggan Anda.
                </p>
                <div class="text-center">
                  <a href="{{ route('home') }}">Kembali ke Halaman Utama</a> <br>
                  <a href="{{ route('home.login') }}">Login Pelanggan</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection