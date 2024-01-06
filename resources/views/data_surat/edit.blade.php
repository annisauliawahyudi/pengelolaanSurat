@extends('layouts.template')

@section('tittle', 'Edit Data Surat')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('letter.index') }}">Data Surat</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('letter.create') }}">Edit Data Surat</a>
            </li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
    <form action="{{ route('letter.update', $letter['id']) }}" method="POST">
        @csrf
        @method('PATCH')
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
                            <label for="letter_perihal">Perihal</label>
                            <input type="text" class="form-control" id="letter_perihal" name="letter_perihal"
                                value="{{ old('letter_perihal') }}" required autofocus>
                            @error('letter_perihal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="letter_type_id">Klarifikasi Surat</label>
                            <input type="text" class="form-control" id="letter_type_id" name="letter_type_id"
                                value="{{ old('letter_type_id') }}">
                            @foreach ($letter as $item)
                                
                            @endforeach
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="letter_type_id" class="form-label">Klasifikasi Surat</label>
                            <select class="form-select" aria-label="Klasifikasi Surat" name="letter_type_id"
                                id="letter_type_id">
                                <option selected disabled>Surat</option>
                                @foreach ($letter as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_type }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="content">Isi Surat</label>
                            <input id="content" type="hidden" name="content">
                            <trix-editor input="content"></trix-editor>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Peserta</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="recipients_{{ $item->id }}" name="recipients[]"
                                                        value="{{ $item->id }}">
                                                    <label class="form-check-label"
                                                        for="recipients_{{ $item->id }}">{{ $item->name }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="">Notulis</label>
                            {{-- <select name="notulis" id="notulis">
                                <option selected disabled>Notulis</option>
                                @foreach ($gurus as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('letter.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
