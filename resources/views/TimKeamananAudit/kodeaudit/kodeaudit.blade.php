@extends('TimKeamananAudit.keamananaudit_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kode Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kode Audit Sistem Informasi Rutin
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session()->has('suksestambah'))
            <div class="alert alert-success" role="alert">
                {{ session('suksestambah') }}
            </div>
        @endif
        @if (session()->has('sukseshapus'))
            <div class="alert alert-danger" role="alert">
                {{ session('sukseshapus') }}
                {{-- Coba lagi setelah ini. --}}
            </div>
        @endif
        @if (session()->has('suksesubah'))
            <div class="alert alert-success" role="alert">
                {{ session('suksesubah') }}
            </div>
        @endif

        <!-- Minimal jQuery Datatable end -->
        <!-- Basic Tables start -->
        <section class="section">
            <a href="{{ route('audit-code.create') }}" class="btn btn-secondary mt-4">
                Tambah
            </a>

            <div class="card mt-4">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Audit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($laporan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <!-- Checkbox added -->
                                        <td>{{ $item->kode_audit }}</td>
                                        <td>
                                            <a href="{{ route('audit-code.edit', $item->id) }}"
                                                class="btn btn-warning">Update</a>
                                            <form action="{{ route('audit-code.delete', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->

    </div>
@endsection
