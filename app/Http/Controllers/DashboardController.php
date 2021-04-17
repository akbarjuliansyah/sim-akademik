<?php

namespace App\Http\Controllers;

use App\Student;
use App\Course;
use App\Teacher;
use App\Classroom;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $count_guru = Teacher::all()->count();
        $count_siswa = Student::all()->count();
        $count_kelas = Classroom::all()->count();
        $count_pelajaran = Course::all()->count();
        return view('admin.dashboard', ['count_siswa' => $count_siswa, 'count_pelajaran' => $count_pelajaran, 'count_guru' => $count_guru, 'count_kelas' => $count_kelas]);
    }
}
