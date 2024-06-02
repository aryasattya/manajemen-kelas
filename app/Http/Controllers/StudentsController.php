<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Attendance;


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

       

        $title = 'Daftar siswa';
        $students = $query->get();

        return view('students.index', compact('students', 'title', ));
    }

    public function show(Students $student)
    {

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
    
        ]);


        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'User Berhasil Di ubah.');
    }

    public function edit(Students $student)
    {

     
        $title = 'Edit Siswa';
        return view('students.edit', compact('student', 'title'));
    }


    public function destroy(Students $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Siswa berhasil di hapus.');
    }


    public function absen(Students $student)
    {
        
        $currentTime = Carbon::now();

        $status = 'present';

        $date = $currentTime->toDateString();

        $watcht = $currentTime->toTimeString();

        if ($currentTime->between(Carbon::createFromTimeString('06:00:00'), Carbon::createFromTimeString('07:30:00'))) {
            $description = 'Tepat waktu';
        } elseif ($currentTime->between(Carbon::createFromTimeString('07:30:01'), Carbon::createFromTimeString('14:00:00'))) {
            $description = 'Terlambat';
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

    public function showAbsensi(Students $student)
    {
        $attendance = Attendance::whereHas('student', function ($query) use ($student) {
            $query->where('id', $student->id);
        })->get();
    
        $title = "Detail Absensi " . $student->name;
    
        // Menampilkan halaman dengan data absensi
        return view('students.showAbsensi', compact('student', 'attendance', 'title'));
    }
    
}
