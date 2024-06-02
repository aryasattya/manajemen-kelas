@extends('layouts.main')

@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h1 class="card-title">Data Absensi</h1>
                            <!-- Search form -->
                            <form id="search-form" class="form-inline float-right" action="{{ route('attendance.index') }}" method="GET">
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
                            @if ($attendance)
                                @if ($attendance->isEmpty())
                                    <p>Tidak ada data absensi untuk siswa ini.</p>
                                @else
                                    <table id="categories" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Jam</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendance as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->student->name }}</td>
                                                    <td>{{ $data->status }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>{{ $data->watcht }}</td>
                                                    <td>{{ $data->date }}</td>
                                                    <td>
                                                        <a href="{{ route('attendance.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form id="delete-form-{{ $data->id }}" action="{{ route('attendance.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $data->id }})">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            @else
                                <p>Data absensi tidak tersedia.</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
