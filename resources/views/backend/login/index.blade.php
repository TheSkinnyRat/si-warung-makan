@extends('frontend.index')
@section('main-content-page')
  <div id="main_content" style="display: none;">
    <section id="secHeader" class="row h-75 my-3 my-md-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                      <div class="col-lg-6 d-none d-lg-block">
                        <img src="https://source.unsplash.com/fJXv46LT7Xk/600x500/" class="h-100 w-100" alt="Responsive image">
                      </div>
                      <div class="col-lg-6">
                          <div class="p-5">
                              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                              </div>
                              @if (session('error'))
                                <div class="alert alert-warning" role="alert">
                                  {{ session('error') }}
                                </div>
                              @endif
                              <form class="user" action="{{ route('backend.login.do') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" placeholder="Username" value="{{ old('username') }}">
                                    @error('username')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Password" value="{{ old('password') }}">
                                    @error('password')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div> --}}
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>

                              </form>
                              <hr>
                              <div class="text-center">
                                <a class="small" href="pelanggan_daftar.html">Daftar Untuk Pelanggan</a>
                              </div>
                              <div class="text-center">
                                <a class="small" href="{{ route('home') }}">Kembali ke Halaman Menu Utama</a>
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