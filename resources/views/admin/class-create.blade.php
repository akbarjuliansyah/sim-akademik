@extends('layouts.class-admin')

@section('title', 'Halaman Tambah Kelas')

@section('header-title', 'Form Tambah Kelas')

@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Kelas</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('store-kelas')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Kelas</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama kelas">
                </div>
                <div class="form-group @error('course_id') has-error @enderror">
                    <label for="course">Mata Pelajaran</label>
                    <select class="form-control select2" id="course" name="course_id">
                        <option selected disabled value>Pilih mata pelajaran..</option>
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group @error('teacher_id') has-error @enderror">
                    <label for="teacher">Guru</label>
                    <select class="form-control select2" id="teacher" name="teacher_id">
                        <option selected disabled value>Pilih guru pengajar..</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{$teacher->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="grade">Kelas</label>
                    <select class="form-control @error('grade') is-invalid @enderror" id="grade-edit" name="grade">
                        <option selected disabled value>Pilih kelas..</option>
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
                        <option selected disabled value>Pilih jurusan..</option>
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                    </select>
                    @error('majors')
                    <div class=" invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group @error('teacher_id') has-error @enderror">
                    <label>Pilih siswa (dapat lebih dari 1)</label>
                    <select class="select2" multiple="multiple" data-placeholder="Pilih siswa" style="width: 100%;"
                        id="student_id" name="student_id[]">
                        @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}
                        </option>
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

<div class="modal fade" id="modal-hapus-kelas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin mengahapus?</p>
            </div>
            <form action="/daftar-kelas/{{$no=1}}" method="POST" id="action-hapus">
                <div class="modal-footer justify-content-between">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus Data</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




@endsection
