<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Attendance;
use App\Models\User;

use Carbon\Carbon;

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


public function destroy(Students $student)
{
    $student->delete();

    return redirect()->route('students.index')->with('success', 'Siswa berhasil di hapus.');
}


public function absen( Students $student)
{
    // Mendapatkan waktu sekarang
    $currentTime = Carbon::now();

    // Mengatur status ke "present"
    $status = 'present';

    // Mengatur tanggal dengan tanggal sekarang
    $date = $currentTime->toDateString();

    // Mengatur jam dengan jam sekarang
    $watcht = $currentTime->toTimeString();

    // Menentukan keterangan berdasarkan waktu absen
    if ($currentTime->lte(Carbon::parse('07:30:00'))) {
        $description = 'Tepat waktu';
    } elseif ($currentTime->lte(Carbon::parse('09:00:00'))) {
        $description = "Terlambat";
    } else {
        return redirect()->route('students.index')->with('error', 'Waktu absen telah berakhir.');
    }

    




    $attendance = new Attendance([
        'status' => $status,
        'description' => $description,
        'date' => $date,
        'watcht' => $watcht,
        'student_id' => $student->id,

    ]);

    $attendance->save();
 
    return redirect()->route('attendance.index')->with('success', 'Siswa berhasil Absen');
}



}
