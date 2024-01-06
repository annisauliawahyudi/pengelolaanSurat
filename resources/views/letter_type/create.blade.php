@extends('layouts.template')

@section('tittle', 'Tambah Data Klarifikasi Surat')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('letter_type.index') }}">Data Klasifikasi Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('letter_type.create') }}">Tambah Data Klasifikasi Surat</a></li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
    <form action="{{ route('letter_type.store') }}" method="POST">
        @csrf

        @if (Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
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
                            <label for="letter_code">Kode Surat</label>
                            <input type="text" class="form-control" id="letter_code" name="letter_code"
                                value="{{ old('letter_code') }}">
                        </div>
                        <div class="form-group">
                            <label for="name_type">Klarifikasi Surat</label>
                            <input type="text" class="form-control" id="name_type" name="name_type"
                                value="{{ old('name_type') }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('letter_type.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
