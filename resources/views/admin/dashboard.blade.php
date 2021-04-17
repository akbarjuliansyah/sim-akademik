@extends('layouts.master-admin')

@section('title', 'Halaman Dashboard Admin')

@section('header-title', 'Halaman Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$count_siswa}}</h3>

                <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <a href="{{route('daftar-siswa')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-6">

        <!-- small card -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$count_guru}}</h3>

                <p>Jumlah Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="{{route('daftar-guru')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$count_pelajaran}}</h3>

                <p>Jumlah Mata Pelajaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-book-open"></i>
            </div>
            <a href="{{route('daftar-pelajaran')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$count_kelas}}</h3>

                <p>Jumlah Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-landmark"></i>
            </div>
            <a href="{{route('daftar-kelas')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection
