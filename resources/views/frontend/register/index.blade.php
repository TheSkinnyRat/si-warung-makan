@extends('frontend.index')

@section('main-content-page')
  <div id="main_content" style="display: none;" class="h-100">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                      <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                      <div class="col-lg-6">
                          <div class="p-5">
                              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Pelanggan</h1>
                              </div>
                              @if (session('error'))
                                <div class="alert alert-warning" role="alert">
                                  {{ session('error') }}
                                </div>
                              @endif
                              <form class="user" action="{{ route('home.register.do') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                                    @error('nama')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email" placeholder="Alamat Email" value="{{ old('email') }}">
                                    @error('email')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </button>
                              </form>
                              <hr>
                              <p class="text-muted text-center">
                                Setelah melakukan pendaftaran, Anda akan mendapatkan ID Pelanggan unik yang bisa Anda gunakan untuk memesan makanan.
                                <span class="text-danger">
                                  Harap catat atau simpan ID Pelanggan Anda.
                                </span>
                              </p>
                              <hr>
                              <div class="text-center">
                                <a href="{{ route('home.login') }}" class="small">Login Pelanggan</a> <br>
                                <a class="small">Lupa ID Pendaftaran? (Dalam pengembangan)</a> <br>
                                <a href="{{ route('home') }}" class="small">Kembali ke Halaman Menu Utama</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection