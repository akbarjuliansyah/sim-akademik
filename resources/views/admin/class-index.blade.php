@extends('layouts.class-admin')

@section('title', 'Halaman Daftar Kelas')

@section('header-title', 'Halaman Daftar Kelas')

@section('content')
<div class="col-md-12">
    <a href="{{route('create-kelas')}}" class="btn bg-gradient-success mb-3">Tambah Kelas Baru</a>
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

    {{-- @php
    dd($classroom_teachers);
    @endphp --}}

    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Daftar Kelas SMA N 5 Denpasar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @foreach ($classrooms as $classroom)

            <div id="accordion">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            <div class="d-flex justify-content-between">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapse-{{$classroom->id}}"
                                    aria-expanded="true">
                                    {{$classroom->name}}
                                </a>
                                <div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </h4>
                        <a href="/daftar-kelas/edit/{{$classroom->id}}/show"
                            class="btn btn-sm bg-gradient-primary mt-2 btn-edit-pelajaran">Edit</a>
                        <button type="button" class="btn btn-sm bg-gradient-danger mt-2 btn-hapus-kelas"
                            data-toggle="modal" data-target="#modal-hapus-kelas"
                            data-id="{{$classroom->id}}">Hapus</button>
                    </div>
                    <div id="collapse-{{$classroom->id}}" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 col-sm-6 col-12">
                                    <div class="info-box shadow-sm">
                                        <span class="info-box-icon bg-warning"><i
                                                class="fas fa-chalkboard-teacher"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Guru Pengampu</span>
                                            <span class="info-box-number">
                                                @foreach ($classroom_teachers as $classroom_teacher)
                                                @if ($classroom_teacher->id == $classroom->id)
                                                {{$classroom_teacher->name}}
                                                @endif
                                                @endforeach
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box shadow-sm">
                                        <span class="info-box-icon bg-danger"><i class="fas fa-users"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Jumlah Siswa</span>
                                            <span class="info-box-number">
                                                @php
                                                $count_siswa = 0;
                                                @endphp
                                                @foreach ($classroom_members as $classroom_member)
                                                @if ($classroom_member->class_id == $classroom->id)
                                                @php
                                                $count_siswa++;
                                                @endphp
                                                @endif
                                                @endforeach
                                                {{$count_siswa}}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="info-box shadow-sm">
                                        <span class="info-box-icon bg-info"><i class="fas fa-landmark"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Kelas</span>
                                            <span class="info-box-number">{{$classroom->grade}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="info-box shadow-sm">
                                        <span class="info-box-icon bg-success"><i class="fas fa-pen"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Jurusan</span>
                                            <span class="info-box-number">{{$classroom->majors}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Siswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($classroom_members as $classroom_member)
                                    @if ($classroom_member->class_id == $classroom->id)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            {{$classroom_member->name}}
                                        </td>
                                        @php
                                        $no++;
                                        @endphp
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
        </div>
    </div>
</div>




<div class="modal fade" id="modal-tambah-kelas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-kelas') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" id="label-testnih">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama mata pelajaran" name="name" value="{{old('name')}}">
                        @error('name')
                        <div class=" invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="majors">Jurusan</label>
                        <select class="form-control @error('majors') is-invalid @enderror" name="majors">
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

<div class="modal fade" id="modal-edit-kelas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/daftar-kelas/edit/id/update" method="POST" id="action-edit">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name" id="label-testnih">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-edit"
                            placeholder="Masukkan nama mata pelajaran" name="name">
                        @error('name')
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
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit Mata Pelajaran</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
            <form action="/daftar-kelas/id" method="POST" id="action-hapus">
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
