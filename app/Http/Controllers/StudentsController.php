<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('admin.students-index', ['students' => $students]);
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
            'nisn' => 'required|size:10|unique:students,nisn',
            'grade' => 'required',
            'gender' => 'required',
            'majors' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        Student::create($request->all());
        return redirect(route('daftar-siswa'))->with('status-tambah', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        $result = Student::find($student);

        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $rules = [
            'name' => 'required',
            'nisn' => 'required|size:10',
            'grade' => 'required',
            'gender' => 'required',
            'majors' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        Student::where('id', $student->id)
            ->update([
                'name' => $request->name,
                'nisn' => $request->nisn,
                'grade' => $request->grade,
                'gender' => $request->gender,
                'majors' => $request->majors,
                'birthdate' => $request->birthdate
            ]);
        return redirect(route('daftar-siswa'))->with('status-edit', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        Student::destroy($student->id);
        return redirect(route('daftar-siswa'))->with('status-delete', 'Data berhasil dihapus!');
    }
}
