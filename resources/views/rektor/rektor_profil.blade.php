@extends('rektor.rektor_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Akun Profile</h3>
                    {{-- <p class="text-subtitle text-muted">A page where users can change profile information</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-pimpinan">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ asset('assets/compiled/jpg/2.jpg') }}" alt="Avatar">
                                </div>

                                <h3 class="mt-3">{{ $user->role }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Username</label>
                                        <input disabled type="text" name="name" id="name" class="form-control"
                                            placeholder="Your Name" value="{{ $user->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input disabled type="email" name="email" id="email" class="form-control"
                                        placeholder="Your Email" value="{{ $user->email }}">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
