<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            


        }

        $title = 'Daftar User';
        $users = $query->get();

        return view('users.index', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'User Berhasil Di tambahkan.');

    }

    public function edit(User $user)

    {
        $title = 'Edit User';
        return view('users.edit', compact('user', 'title'));
    }

    public function update(Request $request, User $user)
    {
       

        $request->validate([
            'username' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|nullable|string|min:8',
        ]);

      

        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'User Berhasil Di ubah.');
        
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil di hapus.');
    }

}
