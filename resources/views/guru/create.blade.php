@extends('layouts.template')

@section('tittle', 'Tambah Data Guru')

@section('content')
<!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('guru.index') }}">Data Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('guru.create') }}">Tambah Data Guru</a></li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
    <form action="{{ route('guru.store') }}" method="POST">
        @csrf

        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>

                        {{-- Remove the role selection dropdown --}}
                    </div>

                    {{-- Set the default role for guru --}}
                    <input type="hidden" name="role" value="guru">

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('guru.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
