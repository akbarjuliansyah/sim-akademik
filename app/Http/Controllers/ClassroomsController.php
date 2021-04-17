<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Course;
use App\Teacher;
use App\ClassroomDetail;
use App\Student;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data
        $classrooms = Classroom::all();

        // Mengambil nama guru berdasarkan teacher_id
        $classroom_teachers = Classroom::select(
            "classes.id",
            "teachers.name"
        )->join("teachers", "classes.teacher_id", "=", "teachers.id")->get();

        // Mengambil nama dan id siswa berdasarkan student_id
        $classroom_members = ClassroomDetail::select(
            "students.id",
            "students.name",
            "class_details.class_id",
        )->join("students", "class_details.student_id", "=", "students.id")
            ->join("classes", "class_details.class_id", "=", "classes.id")->get();

        return view('admin.class-index', ['classrooms' => $classrooms, 'classroom_members' => $classroom_members, 'classroom_teachers' => $classroom_teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil data tabel untuk option input
        $courses = Course::all();
        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.class-create', ['courses' => $courses, 'teachers' => $teachers, 'students' => $students]);
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
            'course_id' => 'required',
            'teacher_id' => 'required',
            'grade' => 'required',
            'majors' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        // Buat objek dari class Classroom
        $classroom = new Classroom;

        // Isi property objek
        $classroom->name = $request->name;
        $classroom->course_id = $request->course_id;
        $classroom->teacher_id = $request->teacher_id;
        $classroom->grade = $request->grade;
        $classroom->majors = $request->majors;

        //Simpan data ke database
        $classroom->save();

        // Ambil row terakhir/terbaru dari tb class, supaya bisa dapet id nya
        $latest_classroom = Classroom::latest()->first();

        // tambah data detail class sejumlah siswa yang ditambahkan
        foreach ($request->student_id as $student_id) {
            $classroom_detail = new ClassroomDetail;
            $classroom_detail->class_id = $latest_classroom->id;
            $classroom_detail->student_id = $student_id;
            $classroom_detail->save();
        }
        // Classroom::create($request)

        // Student::create($request->all());
        return redirect(route('daftar-kelas'))->with('status-tambah', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
        // ambil data tabel untuk option input
        $courses = Course::all();
        $teachers = Teacher::all();
        $students = Student::all();

        // Ambil data siswa dari kelas yang diedit
        $classroom_member = ClassroomDetail::select(
            "class_details.student_id",
            "students.name",
            "students.id"
        )->join("students", "class_details.student_id", "=", "students.id")->where('class_id', $classroom->id)->get();

        // dd($classroom_member);
        // dd($classroom_member);

        // Ambil nama dari id course
        $course_name_selected = Course::select("courses.name")->where('courses.id', $classroom->course_id)->get();

        //ambil nama dari id teacher
        $teacher_name_selected = Teacher::select("teachers.name")->where('teachers.id', $classroom->teacher_id)->get();


        return view('admin.class-edit', ['classroom' => $classroom, 'classroom_member' => $classroom_member, 'courses' => $courses, 'course_selected_name' => $course_name_selected[0], 'teacher_selected_name' => $teacher_name_selected[0], 'teachers' => $teachers, 'students' => $students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
        $rules = [
            'name' => 'required',
            'course_id' => 'required',
            'teacher_id' => 'required',
            'grade' => 'required',
            'majors' => 'required'
        ];

        $customMessage = [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'size' => 'panjang karakter :attribute harus 10.'
        ];

        $request->validate($rules, $customMessage);

        // Perbarui row di tabel classes
        Classroom::where('id', $classroom->id)
            ->update([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'teacher_id' => $request->teacher_id,
                'grade' => $request->grade,
                'majors' => $request->majors
            ]);

        // Untuk perbarui tabel detail
        // Dengan cara hapus, setelah itu ditambahkan lg

        ClassroomDetail::where('class_id', $classroom->id)->delete();

        foreach ($request->student_id as $student_id) {
            $classroom_detail = new ClassroomDetail;
            $classroom_detail->class_id = $classroom->id;
            $classroom_detail->student_id = $student_id;
            $classroom_detail->save();
        }

        return redirect(route('daftar-kelas'))->with('status-edit', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //hapus row di tabel detail dengan id class terkait
        ClassroomDetail::where('class_id', $classroom->id)->delete();

        //hapus row class di tb class
        Classroom::destroy($classroom->id);
        return redirect(route('daftar-kelas'))->with('status-delete', 'Data berhasil dihapus!');
    }
}
