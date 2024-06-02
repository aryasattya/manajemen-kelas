@extends('layouts.main')

@section('title', $title)

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- Form Tambah Data di Kiri -->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h1 class="card-title font-weight-bold">{{ $title }}</h1>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('students.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama siswa</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="nisn" class="form-control" id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="major">Jurusan</label>
                                    <input type="major" class="form-control" id="major" name="major" value="{{ old('nisn') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="address" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">No.Hp</label>
                                    <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                </div>

                               
                                    <div class="form-group">
                                        <label for="user_id">Username</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}" class="form-control">{{ $item->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                               

                              
                                   
                        
                                                    
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col-md-4 -->

                <!-- Daftar User di Kanan -->
                <div class="col-md-8">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h1 class="card-title font-weight-bold">{{$title}}</h1>
                            <!-- Search form -->
                            <form id="search-form" class="form-inline float-right" action="{{ route('users.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" id="search-input" name="search" class="form-control" placeholder="Search" value="{{ request()->input('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            

                         
                            <table id="users" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>no.</th>
                                        <th>Nama</th>
                                        <th>Nisn</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->nisn }}</td>
                                  
            
                                            
                                            <td class="d-flex">
                                                <a href="{{ route('students.edit', $data->id) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                                                <a href="{{ route('students.show', $data->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                                <form id="delete-form-{{ $data->id }}" action="{{ route('students.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm mr-1" onclick="confirmDeletion({{ $data->id }})">Hapus</button>
                                                </form>
                                            
                                                <form action="{{ route('students.absen', ['student' => $data->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm mr-1">Absen</button>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-8 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('data-tables-script')

    <!-- jQuery -->
    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables & Plugins -->
    <script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>

    <script>
        $(function() {
            var table = $("#users").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });

            table.buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
        });
    </script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeletion(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Kategori Anda telah dihapus.",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
