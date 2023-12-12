@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 row">
                <div class="col-sm-12">&nbsp;</div>
                <div class="col-sm-12">
                    <div class="card p-5 m-5">
                        <h2><strong>LOGIN</strong></h2>
                        @include('shared.error')
                        <form method="post" action="{{ route('user.auth') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="idnumber" class="form-label">ID NUMBER</label>
                                <input type="text" class="form-control" name="id_number" value="{{ old('id_number') }}"
                                    id="id_number">
                                @error('id_number')
                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>

                                <input type="password" class="form-control " name="password">
                                @error('password')
                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-dark w-100">LOGIN</button>
                        </form>
                        <div class="suggestion mt-3">
                            <p style="margin:0px;">Not a memeber? <a
                                    href="{{ route('register') }}"><strong>Register</strong></a></p>
                            <p style="margin:0px;">Login as administrator? <a
                                    href="{{ route('login_admin') }}"><strong>Here</strong></a>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12"></div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
@endsection
