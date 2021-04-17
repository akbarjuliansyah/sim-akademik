<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambbil data guru sama nama mata pelajaran yang diajarkan, dengan join ke tb courses
        $teachers = Teacher::select(
            "teachers.id",
            "teachers.name",
            "teachers.nip",
            "courses.name as course_name",
            "teachers.gender"
        )->join("courses", "courses.id", "=", "teachers.courses_id")->get();

        // Untuk menampilkan opsi mata pelajaran di modal tambah
        $courses = Course::select(
            "courses.id",
            "courses.name"
        )->get();

        return view('admin.teacher-index', ['teachers' => $teachers, 'courses' => $courses]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required',
            'nip' => 'required|unique:teachers,nip',
            'gender' => 'required',
            'courses_id' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        Teacher::create($request->all());
        return redirect(route('daftar-guru'))->with('status-tambah', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        // Ambil data kemudian return JSON untuk jquery modal
        $result = Teacher::find($teacher);

        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $rules = [
            'name' => 'required',
            'nip' => 'required',
            'gender' => 'required',
            'courses_id' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        Teacher::where('id', $teacher->id)
            ->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'courses_id' => $request->courses_id,
                'gender' => $request->gender
            ]);
        return redirect(route('daftar-guru'))->with('status-edit', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        Teacher::destroy($teacher->id);
        return redirect(route('daftar-guru'))->with('status-delete', 'Data berhasil dihapus!');
    }
}
