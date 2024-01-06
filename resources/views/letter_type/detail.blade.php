@extends('layouts.template')

@section('title', 'Detail Klasifikasi Surat')

@section('content')
    <h4>Data Klasifikasi Surat</h4>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('letter_type.index') }}">Data Klasifikasi Surat</a></li>
            <li class="breadcrumb-item" aria-current="page">Detail Klasifikasi Surat</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->

    <div class="row row-cols-3 mt-5">
        <div class="col">
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <h4 class="fw-bold mb-0">220604-1</h4>
                    <p class="mb-0 text-dark">| Rapat Guru</p>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0"><strong>Rapat Rutin</strong></h6>
                            <a href="/download-pdf-klasifikasi-surat">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                        <div>
                            <p class="mb-2"><b>17 Desember 2023</b></p>
                            <ul class="list-unstyled px-3">
                                <li>1. Dinda S.S.</li>
                                <li>2. Aira S.I.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection