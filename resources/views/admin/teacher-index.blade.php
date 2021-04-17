@extends('layouts.teacher-admin')

@section('title', 'Halaman Daftar Guru')

@section('header-title', 'Halaman Daftar Guru')

@section('content')
<div class="col-md-12">
    <button type="button" class="btn bg-gradient-success mb-3" data-toggle="modal"
        data-target="#modal-tambah-guru">Tambah Guru Baru</button>
    @if (session('status-tambah'))
    <div class="card card-info shadow">
        <div class="card-header">
            <h3 class="card-title">{{session('status-tambah')}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>
    @endif
    @if (session('status-delete'))
    <div class="card card-danger shadow">
        <div class="card-header">
            <h3 class="card-title">{{session('status-delete')}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>
    @endif

    @if (session('status-edit'))
    <div class="card card-warning shadow">
        <div class="card-header">
            <h3 class="card-title">{{session('status-edit')}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
    </div>
    @endif


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Guru SMA N 5 Denpasar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th style="width: 150px">NIP</th>
                        <th style="width: 150px">Jenis Kelamin</th>
                        <th style="width: 150px">Mata Pelajaran</th>
                        <th style="width: 130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{$loop->iteration}}.</td>
                        <td>{{$teacher->name}}</td>
                        <td>{{$teacher->nip}}</td>
                        <td>@if ($teacher->gender == 'L')
                            {{'Laki-laki'}}
                            @elseif ($teacher->gender == 'P')
                            {{'Perempuan'}}
                            @endif</td>
                        <td>{{$teacher->course_name}}</td>
                        <td>
                            <button type="button" class="btn btn-sm bg-gradient-primary btn-edit-guru"
                                data-toggle="modal" data-target="#modal-edit-guru"
                                data-id="{{$teacher->id}}">Edit</button>
                            <button type="button" class="btn btn-sm bg-gradient-danger btn-hapus-guru"
                                data-toggle="modal" data-target="#modal-hapus-guru"
                                data-id="{{$teacher->id}}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class=" card-footer clearfix">
        </div>
    </div>
</div>


<div class="modal fade modalTambah" id="modal-tambah-guru">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Guru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-guru') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="Masukkan nama lengkap" name="name" value="{{old('name')}}">
                        @error('name')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip"
                            placeholder="Nomer Induk Pegawai" name="nip" value="{{old('nip')}}">
                        @error('nip')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" checked="" value="L">
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="P">
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group @error('courses_id') has-error @enderror">
                        <label for="course">Mata Pelajaran</label>
                        <select class="form-control select2" id="course" name="courses_id">
                            <option selected disabled value>Pilih mata pelajaran..</option>
                            @foreach ($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-edit-guru">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Guru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/daftar-guru/edit/{{$teacher->id}}/update" method="POST" id="action-edit">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-edit"
                            placeholder="Masukkan nama lengkap" name="name">
                        @error('name')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip-edit"
                            placeholder="Nomer Induk Pegawai" name="nip">
                        @error('nip')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" checked="" value="L"
                                id="gender-l-edit">
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="P" id="gender-p-edit">
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="form-group @error('courses_id') has-error @enderror">
                        <label for="course-id-edit">Mata Pelajaran</label>
                        <select class="form-control select2" id="course-id-edit" name="courses_id">
                            {{-- <option selected disabled value>Pilih mata pelajaran..</option> --}}
                            @foreach ($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit Guru</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-hapus-guru">
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
            <form action="/daftar-guru/{{$teacher->id}}" method="POST" id="action-hapus">
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
<!-- /.modal -->

<!-- /.modal -->

@endsection
