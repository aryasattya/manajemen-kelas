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
                   <form action="{{ route('users.update', $user->id) }}" method="POST">
                       @csrf
                       @method('PUT')
                       <div class="card-body">
                           <div class="form-group">
                               <label for="username">Username</label>
                               <input type="text" class="form-control" id="username" name="username"
                                   value="{{ $user->username }}">
                           </div>

                       </div>

                       <div class="card-body">
                           <div class="form-group">
                               <label for="email">Email</label>
                               <input type="email" class="form-control" id="email" name="email"
                                   value="{{ $user->email }}">
                           </div>
                       </div>

                       <div class="card-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                            
                                <option value="student"
                                 {{ old('role', $user->role) == $user->role ? 'selected' : '' }}>
                                 Student
                             </option>

                             <option value="admin"
                                 {{ old('role', $user->role) == $user->role ? 'selected' : '' }}>
                                 Admin
                             </option>
                              
                            </select>
                        </div>
                    </div>


                       <div class="card-body">
                           <div class="form-group">
                               <label for="password">Password</label>
                               <input type="password" class="form-control" id="password" name="password">
                           </div>
                       </div>
                       <div class="card-body">
                           <div class="form-group">
                               <label for="password_confirmation">Confirm Password</label>
                               <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation">
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
