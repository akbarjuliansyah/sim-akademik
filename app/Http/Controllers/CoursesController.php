<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data
        $courses = Course::all();
        return view('admin.course-index', ['courses' => $courses]);
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
            'majors' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        Course::create($request->all());
        return redirect(route('daftar-pelajaran'))->with('status-tambah', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        // Ambil data kemudian return JSON untuk jquery modal
        $result = Course::find($course);

        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
        $rules = [
            'name' => 'required',
            'majors' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        Course::where('id', $course->id)
            ->update([
                'name' => $request->name,
                'majors' => $request->majors,
            ]);
        return redirect(route('daftar-pelajaran'))->with('status-edit', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
        Course::destroy($course->id);
        return redirect(route('daftar-pelajaran'))->with('status-delete', 'Data berhasil dihapus!');
    }
}
