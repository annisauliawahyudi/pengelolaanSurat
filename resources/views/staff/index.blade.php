@extends('layouts.template')

@section('tittle', 'Data Staff Tata Usaha')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Staff Tata Usaha</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if (Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    @if (Session::get('error'))
        <div class="alert alert-warning"> {{ Session::get('error') }} </div>
    @endif

    <div class="card shadow mb-4">



        <div class="card-body">

            <div class="my-5 d-flex justify-content-end align-items-center">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('staff.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" id="searchInput"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="searchStaff()">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('staff.index') }}" class="btn btn-secondary mb-2 mx-2"><i class="fas fa-trash fa-sm"></i></a>
                <a href="{{ route('staff.create') }}" class="btn btn-primary mb-2">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <script>
                        function searchStaff() {
                            var searchValue = document.getElementById('searchInput').value;
                            // Redirect to the staff search route with the search parameter
                            window.location.href = "{{ route('staff.index') }}?search=" + searchValue;
                        }

                        function confirmDelete() {
                            return confirm('Are you sure you want to delete this staff member?');
                        }
                    </script>   
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($staffs as $staff)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $staff->name }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->role }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="" class="mr-3">Lihat</a>
                                    <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-primary mr-2">Edit</a>

                                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST"
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
        {{-- jika data ada atau > 0 --}}
        @if ($staffs->count())
            {{-- munculkan tampilan pagination --}}
            {{ $staffs->links() }}
        @endif
    </div>
        </div>
    </div>
    
@endsection
