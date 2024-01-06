@extends('layouts.template')

@section('tittle', 'Edit Data Guru')

@section('content')
<!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('guru.index') }}">Data Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="">Edit Data Guru</a></li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
    <form action="{{ route('guru.update', $guru['id']) }}" method="POST">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger P-3">
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
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $guru->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $guru->email }}">
                            <input type="hidden" name="email" value="guru">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                             <a href="{{ route('guru.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
    </form>

@endsection
