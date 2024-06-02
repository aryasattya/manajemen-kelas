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
                    <form action="{{ route('classCashFund.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="student_id">Nama Siswa</label>
                                <select name="student_id" id="student_id" class="form-control">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="amount">Harga</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="5000" readonly required>
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
                        <h1 class="card-title font-weight-bold">{{ $title }}</h1>
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
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classCashFund as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->student->name }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>Rp. {{ $data->amount }}</td>
                                        <td>{{ $data->date}}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('classCashFund.edit', $data->id) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                                            <form id="delete-form-{{ $data->id }}" action="{{ route('classCashFund.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm mr-1" onclick="confirmDeletion({{ $data->id }})">Hapus</button>
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
                    text: "Data Anda telah dihapus.",
                    icon: "success"
                });
            }
        });
    }
</script>
@endsection
