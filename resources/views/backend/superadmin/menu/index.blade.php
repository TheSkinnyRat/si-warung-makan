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
            <h1 class="h3 text-gray-800 font-weight-bold">Manajemen Menu</h1>
            <hr>
          </div>
          <div class="col-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row align-items-center">
                  <div class="col-10">
                    <span class="m-0 font-weight-bold text-primary">Data Menu</span>
                  </div>
                  <div class="col-2 text-right">
                    <a href="{{ route('backend.superadmin.menu.add') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
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
                        <th>Menu</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Img</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($menus as $menu)
                        <tr>
                          <td>{{ $menu->id_menu }}</td>
                          <td>{{ $menu->menu }}</td>
                          <td class="text-truncate" style="max-width: 15vh;">{{ $menu->deskripsi }}</td>
                          <td>@rupiah($menu->harga)</td>
                          <td>{{ $menu->kategori->kategori }}</td>
                          <td>
                            <a href="{{ asset($menu->img) }}" target="_blank">
                              <img src="{{ asset($menu->img) }}" alt="{{ $menu->menu }}" width="100vh">
                            </a>
                          </td>
                          <td>
                            @if ($menu->status == 0)
                              <span class="font-weight-bold text-success font-italic">Tersedia</span>
                            @elseif ($menu->status == 1)
                              <span class="font-weight-bold text-danger font-italic">Stok Habis</span>
                            @else
                              <span class="font-weight-bold text-warning font-italic">Tidak Tersedia</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('backend.superadmin.menu.edit', ['id' => $menu->id_menu]) }}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                            <a href="{{ route('backend.superadmin.menu.delete', ['id' => $menu->id_menu]) }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
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