@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 row">
                <div class="col-sm-12">&nbsp;</div>
                <div class="col-sm-12">
                    <div class="card p-5 m-5">
                        <h2><strong>LOGIN</strong> as administrator</h2>
                        @include('shared.error')
                        @include('shared.success')
                        <form method="post" action="{{ route('admin.auth') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark w-100">LOGIN</button>
                        </form>
                        <form action="{{ route('admin.populate') }}" class="d-none" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger mt-2 w-100">POPULATE</button>
                        </form>
                        <div class="suggestion mt-3">
                            <p style="margin:0px;">Login as students? <a href="{{ route('login_users') }}"><strong>
                                        Here</strong></a></p>


                        </div>
                    </div>
                </div>
                <div class="col-sm-12"></div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
@endsection
