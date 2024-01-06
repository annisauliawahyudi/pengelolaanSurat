@extends('layouts.template')

@section('tittle', 'Data Surat')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Surat</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if (Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="my-5 d-flex justify-content-end align-items-center">
                <form action="" method="GET"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" id="searchInput"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="searchLetter()">
                                <i class="fas fa-search fa-sm"></i>
                            </button>

                        </div>

                    </div>

                </form>

                <a href="{{ route('letter.index') }}" class="btn btn-secondary mb-2 mx-2"><i
                        class="fas fa-trash fa-sm"></i></a>
                <a href="{{ route('letter.create') }}" class="btn btn-primary mb-2">Tambah</a>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Keluar</th>
                            <th>Penerima Surat</th>
                            <th>Notulis</th>
                            <th>Hasil Rapat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <script>
                        // function searchStaff() {
                        //     var searchValue = document.getElementById('searchInput').value;
                        //     // Redirect to the staff search route with the search parameter
                        //     window.location.href = "{{ route('staff.index') }}?search=" + searchValue;
                        // }

                        function confirmDelete() {
                            return confirm('Are you sure you want to delete this latte ?');
                        }
                    </script>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($letters as $letter)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td class="px-6 py-4">
                                    @if ($letter->letter_type)
                                        {{ $letter->letter_type->letter_code }}
                                    @else
                                        Letter type not found
                                    @endif
                                </td>
                                <td>{{ $letter->letter_perihal }}</td>
                                <td>{{ $letter->created_at->format('d M Y') }}</td>
                                <td>
                                    @foreach (json_decode($letter->recipients) as $recipientId)
                                        @php
                                            $recipient = \App\Models\User::find($recipientId);
                                        @endphp
                                        @if ($recipient)
                                            {{ $recipient->name }}
                                        @else
                                            User not found
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if ($letter->user)
                                        {{ $letter->user->name }}
                                    @else
                                        User not found
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($letter->meeting_minutes_status == 'Belum Dibuat')
                                        Hasil Rapat Belum Dibuat
                                    @else
                                        Hasil Rapat Sudah Dibuat
                                    @endif
                                </td>
                                {{-- <td>{{ $row->notes }}</td> --}}
                                <td class="d-flex justify-content-center">
                                    <a href="" class="mr-3">Lihat</a>
                                    <a href="{{ route('letter.edit', $letter->id) }}" class="btn btn-primary mr-2">Edit</a>

                                    <form action="{{ route('letter.destroy', $letter->id) }}" method="POST"
                                        onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flexy justify-content-end">
                @if ($letters->count())
                    {{ $letters->links() }}
                @endif
            </div>
        </div>
        {{-- <nav aria-label="...">
            <ul class="pagination pagination-sm">
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav> --}}

    </div>


    <script>
        function searchLetter() {
            var searchValue = document.getElementById('searchInput').value;
            window.location.href = "{{ route('letter.index') }}?search=" + searchValue;
        }
    </script>
@endsection
