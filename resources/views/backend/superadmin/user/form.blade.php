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
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen User</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">{{ isset($users) ? 'Edit' : 'Tambah' }} User</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.user') }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-{{ Session::get('message-class', 'warning') }}" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <form action="{{ isset($users) ? route('backend.superadmin.user.edit.do', ['id' => $users->id_user]) : route('backend.superadmin.user.add.do') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <label for="username">Username <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Your username" value="{{ isset($users) ? $users->username : old('username') }}">
                      @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-4">
                      <label for="nama">Nama <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Your full name" value="{{ isset($users) ? $users->nama : old('nama') }}">
                      @error('nama')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-6">
                      <label for="password">Password <span class="text-danger">{{ isset($users) ? '' : '*' }}</span></label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Your password">
                      <small class="form-text text-muted">
                        {{ isset($users) ? 'Biarkan kosong jika tidak ingin mengubah password.' : '' }}
                      </small>
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="password">Confirm Password <span class="text-danger">{{ isset($users) ? '' : '*' }}</span></label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Type your password again">
                      <small class="form-text text-muted">
                        {{ isset($users) ? 'Biarkan kosong jika tidak ingin mengubah password.' : '' }}
                      </small>
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="level">Level <span class="text-danger">*</span></label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error('level') is-invalid @enderror" type="radio" name="level" id="level-superadmin" value="0" {{ (isset($users) && $users->level == 0) ? 'checked' : (old('level') == '0' ? 'checked' : '') }}>
                      <label class="form-check-label" for="level-superadmin">Owner</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error('level') is-invalid @enderror" type="radio" name="level" id="level-admin" value="1" {{ (isset($users) && $users->level == 1) ? 'checked' : (old('level') == '1' ? 'checked' : '') }}>
                      <label class="form-check-label" for="level-admin">Staff</label>
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