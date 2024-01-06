@extends('layouts.template')

@section('tittle', 'Edit Data Klasifikasi Surat')

@section('content')
    <form action="{{ route('letter_type.update', $letter_type['id']) }}" method="POST">
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
                            <label for="letter_code">Kode Surat</label>
                            <input type="number" class="form-control" id="letter_code" name="letter_code"
                                value="{{ $letter_type->letter_code }}">
                        </div>
                        <div class="form-group">
                            <label for="name_type">Klasifikasi Surat</label>
                            <input type="text" class="form-control" id="name_type" name="name_type"
                                value="{{ $letter_type->name_type }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                         <a href="{{ route('letter_type.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
