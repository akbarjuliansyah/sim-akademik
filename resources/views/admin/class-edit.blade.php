@extends('layouts.class-admin')

@section('title', 'Halaman Edit Kelas')

@section('header-title', 'Form Edit Kelas')

@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Kelas</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/daftar-kelas/edit/{{$classroom->id}}/update" method="POST">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Kelas</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama kelas"
                        value="{{$classroom->name}}">
                </div>
                <div class="form-group @error('course_id') has-error @enderror">
                    <label for="course">Mata Pelajaran</label>
                    <select class="form-control select2" id="course" name="course_id">
                        <option selected value="{{$classroom->course_id}}">{{$course_selected_name->name}}</option>
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group @error('teacher_id') has-error @enderror">
                    <label for="teacher">Guru</label>
                    <select class="form-control select2" id="teacher" name="teacher_id">
                        <option selected value="{{$classroom->teacher_id}}">{{$teacher_selected_name->name}}</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="grade">Kelas</label>
                    <select class="form-control @error('grade') is-invalid @enderror" id="grade-edit" name="grade">
                        <option selected value="{{$classroom->grade}}">Kelas {{$classroom->grade}}</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                    </select>
                    @error('grade')
                    <div class=" invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group ">
                    <label for="majors">Jurusan</label>
                    <select class="form-control @error('majors') is-invalid @enderror" id="majors-edit" name="majors">
                        <option selected value="{{$classroom->majors}}">Kelas {{$classroom->majors}}</option>
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                    </select>
                    @error('majors')
                    <div class=" invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pilih siswa (dapat lebih dari 1)</label>
                    <select class="select2" multiple="multiple" data-placeholder="Pilih siswa" style="width: 100%;"
                        id="student_id" name="student_id[]">
                        @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->




</div>




@endsection
