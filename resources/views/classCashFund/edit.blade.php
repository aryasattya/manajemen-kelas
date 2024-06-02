@extends('layouts.main')

@section('title', $title)

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
                <!-- form start -->

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

                <form action="{{ route('classCashFund.update', $classCashFund->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="student_id">Nama Siswa</label>
                            <select name="student_id" id="student_id" class="form-control" required>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id', $classCashFund->student_id) == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="paid" {{ old('status', $classCashFund->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ old('status', $classCashFund->status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $classCashFund->amount) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="date">Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $classCashFund->date) }}" required>
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
