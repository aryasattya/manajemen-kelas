<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassCashFund;
use App\Models\Students;
use Illuminate\Validation\Rule;


class ClassCashFundController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassCashFund::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            
            $query->where(function ($q) use ($search) {
                $q->where('status', 'like', '%' . $search . '%')
                  ->orWhere('date', 'like', '%' . $search . '%');
            })
            ->orWhereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }



        $students = Students::all();
        $title = 'Daftar Uang Kas';
        $classCashFund = $query->with('student')->get();

        return view('classCashFund.index', compact('classCashFund', 'title', 'students'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'student_id' => 'required',
            'status' => 'required|in:paid,unpaid',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

        ClassCashFund::create($validatedData);
        return redirect()->route('classCashFund.index')->with('success', 'Data berhasil di tambah.');

    }

    public function edit(ClassCashFund $classCashFund)
    {

      
        $students = Students::all();
        $title = 'Edit Siswa';
        return view('classCashFund.edit', compact('classCashFund', 'title', 'students'));
    }

    public function update(Request $request, ClassCashFund $classCashFund)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id|unique:class_cash_fund,student_id',
            'status' => 'required|in:paid,unpaid',
            'amount' => 'required|integer',
            'date' => [
                'required',
                'date',
                Rule::unique('attendance')->ignore($classCashFund->id),
            ],
            'student_id' => 'required|exists:students,id',
        ], [
            'date.unique' => 'Siswa Sudah bayar uang kas pada tanggal tersebut.'
        ]);
        $classCashFund->update($validatedData);

        return redirect()->route('classCashFund.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ClassCashFund $classCashFund)
    {
        $classCashFund->delete();

        return redirect()->route('classCashFund.index')->with('success', 'Data berhasil dihapus.');
        
    }
}
