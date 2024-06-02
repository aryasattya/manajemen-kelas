<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Attendance;
use App\Models\ClassCashFund;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){

        $studentCount = Students::count();
        $classCashFundCount = ClassCashFund::count();
        $attendanceCount = Attendance::count();
        $title = 'Dasboard';
        return view('dashboard', compact('title','attendanceCount','classCashFundCount','studentCount'));
    }
}
