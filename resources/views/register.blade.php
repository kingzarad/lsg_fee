@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 row m-0 p-0">
                <div class="col-sm-12">&nbsp;</div>
                <div class="col-sm-12">
                    <div class="card p-5 m-4">
                        <h2><strong>REGISTER</strong></h2>
                        @include('shared.success')
                        @include('shared.error')
                        <form method="post" action="{{ route('register.store') }}">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="idnum" class="form-label">*ID Number</label>
                                        <input type="text" class="form-control" value="{{ old('idnum') }}"
                                            name="idnum" id="idnum">
                                        @error('idnum')
                                            <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 row m-0 p-0">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">*Firstname</label>
                                            <input type="text" class="form-control" value="{{ old('fname') }}"
                                                name="fname" id="fname">
                                            @error('fname')
                                                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="lname" class="form-label">*Lastname</label>
                                            <input type="text" class="form-control" value="{{ old('lname') }}"
                                                name="lname" id="lname">
                                            @error('lname')
                                                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="mname" class="form-label">Middlename</label>
                                            <input type="text" class="form-control" value="{{ old('mname') }}"
                                                name="mname" id="mname">
                                            @error('mname')
                                                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 row m-0 p-0">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="course" class="form-label">*Course</label>
                                            <select name="course" class="form-select">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($courses as $row)
                                                    <option value="{{ $row->id }}">
                                                        {{ $row->course_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('course')
                                                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="yrlevel" class="form-label">*Year Level</label>
                                            <input type="text" class="form-control" name="yrlevel" value="{{ old('yrlevel')}}" id="yrlevel">
                                            @error('yrlevel')
                                                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">*Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email')}}" id="email">
                                        @error('email')
                                            <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="sex" class="form-label">Sex</label>

                                        <select name="sex" class="form-select">
                                            <option value="" selected>Choose...</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female </option>
                                        </select>
                                        @error('sex')
                                            <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control regpass" name="password">
                                        @error('password')
                                            <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100">REGISTER</button>
                        </form>
                        <div class="suggestion mt-3">
                            <p style="margin:0px;">Already a memeber? <a href="{{ route('login_users') }}"><strong>
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
