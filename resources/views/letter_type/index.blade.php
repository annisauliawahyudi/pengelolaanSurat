@extends('layouts.template')

@section('tittle', 'Data Klasifikasi Surat')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Klasifikasi Surat</li>
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
                <form action="{{ route('letter_type.search') }}" method="GET"
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
                <a href="{{ route('letter_type.index') }}" class="btn btn-secondary mb-2 mx-2"><i
                        class="fas fa-trash fa-sm"></i></a>
                <a href="{{ route('letter_type.create') }}" class="btn btn-primary mb-2">Tambah</a>
                <a href="{{ route('letter_type.exportExcel') }}" class="btn btn-info mb-1 ml-2">Export Klasifikasi Surat</a>
            </div>



            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Surat</th>
                            <th>Klasifikasi Surat</th>
                            <th>Surat Tertaut</th>
                            <th>aksi</th>
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
                        @foreach ($letter_type as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->letter_code }}</td>
                                <td>{{ $row->name_type }}</td>
                                <td>1</td>
                                <td class="d-flex justify-content-center">
                                    <a href="" class="mr-3">Lihat</a>
                                    <a href="{{ route('letter_type.edit', $row->id) }}"
                                        class="btn btn-primary mr-2">Edit</a>

                                    <form action="{{ route('letter_type.destroy', $row->id) }}" method="POST"
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
                @if ($letter_type->count())
                    {{ $letter_type->links() }}
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
            window.location.href = "{{ route('letter_type.index') }}?search=" + searchValue;
        }
    </script>
@endsection
