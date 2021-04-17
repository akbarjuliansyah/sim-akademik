@extends('layouts.course-admin')

@section('title', 'Halaman Daftar Mata Pelajaran')

@section('header-title', 'Halaman Daftar Pelajaran')

@section('content')
<div class="col-md-12">
    <button type="button" class="btn bg-gradient-success mb-3" data-toggle="modal"
        data-target="#modal-tambah-pelajaran">Tambah Mata Pelajaran Baru</button>
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
        <div class="card-header bg-info">
            <h3 class="card-title">Daftar Mata Pelajaran Jurusan IPA</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Mata Pelajaran</th>
                        <th style="width: 130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($courses as $course)
                    @if ($course->majors=='IPA')

                    <tr>
                        <td>{{$no}}.</td>
                        @php
                        $no++;
                        @endphp
                        <td>{{$course->name}}</td>
                        <td>
                            <button type="button" class="btn btn-sm bg-gradient-primary btn-edit-pelajaran"
                                data-toggle="modal" data-target="#modal-edit-pelajaran"
                                data-id="{{$course->id}}">Edit</button>
                            <button type="button" class="btn btn-sm bg-gradient-danger btn-hapus-pelajaran"
                                data-toggle="modal" data-target="#modal-hapus-pelajaran"
                                data-id="{{$course->id}}">Hapus</button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
        </div>
    </div>
</div>




<div class="card">
    <div class="card-header bg-warning">
        <h3 class="card-title">Daftar Mata Pelajaran Jurusan IPS</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Mata Pelajaran</th>
                    <th style="width: 130px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($courses as $course)
                @if ($course->majors=='IPS')

                <tr>
                    <td>{{$no}}.</td>
                    @php
                    $no++;
                    @endphp
                    <td>{{$course->name}}</td>
                    <td>
                        <button type="button" class="btn btn-sm bg-gradient-primary btn-edit-pelajaran"
                            data-toggle="modal" data-target="#modal-edit-pelajaran"
                            data-id="{{$course->id}}">Edit</button>
                        <button type="button" class="btn btn-sm bg-gradient-danger btn-hapus-pelajaran"
                            data-toggle="modal" data-target="#modal-hapus-pelajaran"
                            data-id="{{$course->id}}">Hapus</button>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class=" card-footer clearfix">
    </div>

</div>


<div class="modal fade" id="modal-tambah-pelajaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Mata Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-pelajaran') }}" method="POST">
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

<div class="modal fade" id="modal-edit-pelajaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Mata Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/daftar-pelajaran/edit/{{$course->id}}/update" method="POST" id="action-edit">
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




<div class="modal fade" id="modal-hapus-pelajaran">
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
            <form action="/daftar-pelajaran/{{$course->id}}" method="POST" id="action-hapus">
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
