@extends('layouts.index')
@section('content')
    <div class="page-wrapper dashboard">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text">Course</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard/Course</li>
                    </ol>
                </div>
            </div>
            <div class="row">

                <div class="col">

                    <a href="{{ route('course') }}" class="btn btn-dark btn-sm mb-3 text-white">Back</a>
                    <div class="card mb-3">
                        <div class="card-body m-3">
                            <div class="pt-4 mb-3">
                                <h5 class="card-title text-left pb-0 fs-4">Create Course</h5>
                            </div>
                            @include('shared.success')
                            @include('shared.error')
                            <form action="{{ route('course.add') }}" method="POST" class="row g-3">
                                @method('POST')
                                @csrf
                                <div class="col-lg-12">
                                    <label for="yourPassword" class="form-label">Course Name</label>
                                    <input type="text" name="course" class="form-control">
                                    @error('course')
                                        <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                    @enderror

                                    <button class=" mt-3 btn btn-dark w-100" type="submit">Submit</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
                <div class="col"></div>

            </div>
        </div>
    </div>
    </div>
@endsection
