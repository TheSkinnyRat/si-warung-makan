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
                                <h1 class="h4 text-gray-900 mb-4">Login Pelanggan</h1>
                              </div>
                              @if (session('message'))
                                <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                                  {{ session('message') }}
                                </div>
                              @endif
                              <form class="user" action="{{ route('home.login.do') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan" id="id_pelanggan" placeholder="ID Pelanggan" value="{{ old('id_pelanggan') }}">
                                    @error('id_pelanggan')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                              </form>
                              <hr>
                              <div class="text-center">
                                <a href="{{ route('home.register') }}" class="small">Daftar Pelanggan</a> <br>
                                <a class="small">Lupa ID Pendaftaran? (Dalam Pengembangan)</a> <br>
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