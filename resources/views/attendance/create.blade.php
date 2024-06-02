@extends('layouts.main')

@section('title', '{{ $title }}')

@section('content')



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">



            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h1 class="card-title">{{ $title }}</h1>


                </div>
                <!-- /.card-header -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <!-- form start -->
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="student_id">Nama Siswa</label>
                            <select name="student_id" id="student_id" class="form-control">
                                @foreach ($students as $item)
                                    <option value="{{ $item->id }}" class="form-control">{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                             
                                <option value="present">Hadir</option>
                                <option value="absent">Tidak Hadir</option>
                                <option value="excused">Izin</option>
                            
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ old('description') }}">
                        </div>

                        <div class="form-group">
                            <label for="watcht">Jam</label>
                            <input type="time" class="form-control" id="watcht" name="watcht"
                                value="{{ old('watcht') }}">
                        </div>

                        <div class="form-group">
                            <label for="date">Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ old('date') }}">
                        </div>
                    </div>
                  
                       

                   


                 
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>

        </div>
    </section>
@endsection
