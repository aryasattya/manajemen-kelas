@extends('layouts.main')

@section('title', '{{ $title }}')

@section('content')



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">



            <!-- general form elements -->
            <div class="card card-primary col-6 p-2">
                <div class="card-header">
                    <h1 class="card-title">{{ $title }}</h1>


                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    @csrf
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="name">Nama Siswa</label>
                            <input type="text" class="form-control" id="name" value="{{ $student->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" value="{{ $student->nisn }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="major">Jurusan</label>
                            <input type="text" class="form-control" id="major" value="{{ $student->major }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" value="{{ $student->address }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">No.hp</label>
                            <input type="text" class="form-control" id="phone" value="{{ $student->phone }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" value="{{ $student->user->username }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" value="{{ $student->user->role }}"
                                readonly>
                        </div>


                        <div class="card-footer">
                            <a href="/students/{{$student->id}}/attendance/show" class="btn btn-primary btn-md">Absensi</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection
