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
                   <form action="{{ route('students.update', $student->id) }}" method="POST">
                       @csrf
                       @method('PUT')
                       <div class="card-body">
                           <div class="form-group">
                               <label for="name">Nama Siswa</label>
                               <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $student->name }}">
                           </div>

                           <div class="form-group">
                               <label for="nisn">NISN</label>
                               <input type="nisn" class="form-control" id="nisn" name="nisn"
                                   value="{{ $student->nisn }}">
                           </div>

                           <div class="form-group">
                               <label for="major">Jurusan</label>
                               <input type="major" class="form-control" id="major" name="major"
                                   value="{{ $student->major }}">
                           </div>

                           <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="address" class="form-control" id="address" name="address"
                                value="{{ $student->address }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">No.Hp</label>
                            <input type="phone" class="form-control" id="phone" name="phone"
                                value="{{ $student->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="user_id">Username</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach ($users as $item)
                                <option value="{{ $item->id }}"
                                 {{ old('user_id', $student->user_id) == $item->id ? 'selected' : '' }}>
                                 {{ $item->username }}
                             </option>
                                @endforeach
                            </select>
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
