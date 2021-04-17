@extends('layouts.students-admin')

@section('title', 'Halaman Daftar Siswa')

@section('header-title', 'Halaman Daftar Siswa')

@section('content')
<div class="col-md-12">
    <button type="button" class="btn bg-gradient-success mb-3" data-toggle="modal"
        data-target="#modal-tambah-siswa">Tambah Siswa Baru</button>
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
            <h3 class="card-title">Daftar Siswa SMA N 5 Denpasar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th style="width: 150px">NISN</th>
                        <th style="width: 100px">Kelas</th>
                        <th style="width: 100px">Jurusan</th>
                        <th style="width: 150px">Jenis Kelamin</th>
                        <th style="width: 150px">Tanggal Lahir</th>
                        <th style="width: 130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{$loop->iteration}}.</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->nisn}}</td>
                        <td>{{$student->grade}}</td>
                        <td>@if ($student->majors == 'IPA')
                            <span class="badge bg-success">IPA</span>
                            @else
                            <span class="badge bg-warning">IPS</span>
                            @endif</td>
                        <td>@if ($student->gender == 'L')
                            {{'Laki-laki'}}
                            @elseif ($student->gender == 'P')
                            {{'Perempuan'}}
                            @endif
                        </td>
                        <td>{{$student->birthdate}}</td>
                        <td>
                            <button type="button" class="btn btn-sm bg-gradient-primary btn-edit-siswa"
                                data-toggle="modal" data-target="#modal-edit-siswa"
                                data-id="{{$student->id}}">Edit</button>
                            <button type="button" class="btn btn-sm bg-gradient-danger" data-toggle="modal"
                                data-target="#modal-hapus-siswa-{{$student->id}}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
        </div>
    </div>
</div>


<div class="modal fade" id="modal-tambah-siswa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-siswa') }}" method="POST">
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
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                            placeholder="Nomer Induk Sekolah Nasional" name="nisn" value="{{old('nisn')}}">
                        @error('nisn')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="grade">Kelas</label>
                        <select class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade">
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
                    <div class="form-group">
                        <label for="majors">Jurusan</label>
                        <select class="form-control @error('majors') is-invalid @enderror" id="majors" name="majors">
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
                    <div class="form-group">
                        <label>Tanggal Lahir</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric"
                                name="birthdate">
                        </div>
                        <!-- /.input group -->
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

<div class="modal fade" id="modal-edit-siswa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/daftar-siswa/edit/{{$student->id}}/update" method="POST" id="action-edit">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name" id="label-testnih">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-edit"
                            placeholder="Masukkan nama lengkap" name="name">
                        @error('name')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn-edit"
                            placeholder="Nomer Induk Sekolah Nasional" name="nisn">
                        @error('nisn')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
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
                    <div class="form-group">
                        <label for="majors">Jurusan</label>
                        <select class="form-control @error('majors') is-invalid @enderror" id="majors-edit"
                            name="majors">
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
                    <div class="form-group">
                        <label>Tanggal Lahir</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric"
                                name="birthdate" id="date-edit">
                        </div>
                        <!-- /.input group -->
                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



@foreach ($students as $student)

<div class="modal fade" id="modal-hapus-siswa-{{$student->id}}">
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
            <form action="/daftar-siswa/{{$student->id}}" method="POST">
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
@endforeach




@endsection
