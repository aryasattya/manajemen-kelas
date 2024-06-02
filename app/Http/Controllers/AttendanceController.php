<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Attendance;
use Illuminate\Validation\Rule;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('attendance', function ($q) use ($search) {
                $q->where('status', 'like', '%' . $search . '%');
                $q->orWhere('description', 'like', '%' . $search . '%');
                $q->orWhere('date', 'like', '%' . $search. '%');
            
            })
            ->orWhereHas('students', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
            
        }

        $title = 'Daftar siswa';
        $attendance = $query->with('student')->get();

        return view('students.index', compact('attendance', 'title','users'));
    }

    public function create(){
        $students = Students::all();
        $title = 'Absen Siswa';
        return view('attendance.create', compact('students', 'title'));
    }

    public function store(Request $request )
    {
        $validatedData = $request->validate([
            'status' => ['required', Rule::in(['present', 'absent', 'excused'])],
            'description' => 'nullable|string',
            'date' => 'required|date|unique:attendance,date',
            'student_id' => 'required|exists:students,id',
        ], [
            'date.unique' => 'Kehadiran untuk tanggal ini sudah ada.'
        ]);

        Attendance::create($validatedData);

        return redirect()->route('attendance.index')->with('success', 'Siswa berhasil Absen');

    }

    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([
            'status' => ['required', Rule::in(['present', 'absent', 'excused'])],
            'description' => 'nullable|string',
            'date' => 'required|date|unique:attendance,date',
            'student_id' => 'required|exists:students,id',
        ], [
            'date.unique' => 'Kehadiran untuk tanggal ini sudah ada.'
        ]);

      
        $attendance->update($validatedData);

        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil di Perbarui.');

    }

    public function destroy(Attendance $attendance)
{
    $attendance->delete();

    return redirect()->route('attendance.index')->with('success', 'Absensi berhasil di hapus.');
}
}
