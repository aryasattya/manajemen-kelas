<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $query = Students::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('nisn', 'like', '%' . $search . '%')
                ->orWhere('major', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            


        }

        $users = User::all();
        
        $title = 'Daftar siswa';
        $students = $query->with('user')->get();

        return view('students.index', compact('students', 'title','users'));
    }

    public function show(Students $student){

        $title = 'Detail Siswa';
        return view('students.show', compact('student', 'title'));
    }


    public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'nisn' => 'required|integer',
        'name' => 'required|string',
        'address' => 'required|string',
        'major' => 'required|string',
        'phone' => 'required|string',
        'user_id' => [
            'required',
            Rule::unique('students')->where(function ($query) use ($request) {
                return $query->where('user_id', $request->user_id);
            }),
        ],
    ], [
        'user_id.unique' => 'Siswa dengan username tersebut sudah tersedia.'
    ]);

    Students::create($validatedData);

    return redirect()->back()->with('success', 'Siswa berhasil disimpan.');
}


public function update(Request $request, Students $student)
{
 
    $validatedData = $request->validate([
        'nisn' => 'required|integer',
        'name' => 'required|string',
        'address' => 'required|string',
        'major' => 'required|string',
        'phone' => 'required|string',
        'user_id' => [
            'required',
            Rule::unique('students')->ignore($student), 
        ],
    ], [
        'user_id.unique' => 'Siswa dengan username tersebut sudah tersedia.'
    ]);

 
    $student->update($validatedData);

    return redirect()->route('students.index')->with('success', 'User Berhasil Di ubah.');

}

public function edit(Students $student){
   
    $users = User::all();
    $title = 'Edit Siswa';
    return view('students.edit', compact('student', 'title', 'users'));
}

public function absen(Students $student){

}

public function destroy(Students $student)
{
    $student->delete();

    return redirect()->route('students.index')->with('success', 'Siswa berhasil di hapus.');
}
}
