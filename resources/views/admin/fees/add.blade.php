@extends('layouts.index')
@section('content')
    <div class="page-wrapper dashboard" style="height: 100% !important">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text">College Fees</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard/College Fees</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col p-0 m-0">
                    <div class=" row p-0 m-0">
                        <div class="col-sm-12 ">
                            <a href="{{ route('fees') }}" class="btn btn-dark btn-sm mb-3 text-white">Back</a>
                            <div class="card mb-5 ">
                                <div class="card-body m-3">
                                    <div class="pt-4 mb-3">
                                        <h5 class="card-title text-left pb-0 fs-4">Create College Fees</h5>
                                    </div>
                                    @include('shared.success')
                                    @include('shared.error')
                                    <form action="{{ route('fees.store') }}" method="POST" class="row g-3">
                                        @method('POST')
                                        @csrf
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label for="yourPassword" class="form-label">Student</label>
                                                <select name="student" class="form-select">
                                                    <option value="" selected>Choose...</option>
                                                    @foreach ($students as $row)
                                                        <option value="{{ $row->id }}">
                                                            {{ $row->id_number . ' / ' . $row->fname . ' ' . $row->lname . ' ' . $row->mname . ' / ' }}

                                                            @foreach ($courses as $item)
                                                                @if ($row->id == $item->id)
                                                                    {{ $item->course_name }}
                                                                @endif
                                                            @endforeach

                                                            {{ ' / ' . $row->year_level }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('student')
                                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="yourPassword" class="form-label">Fee Type</label>
                                                <input type="text" name="fee_type" class="form-control">
                                                @error('fee_type')
                                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="yourPassword" class="form-label">Amount</label>
                                                <input type="text" name="amount" class="form-control">
                                                @error('amount')
                                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="yourPassword" class="form-label">Due Date</label>
                                                <input type="date" name="duedate" class="form-control">
                                                @error('duedate')
                                                    <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <button class=" mt-3 btn btn-dark w-100" type="submit">Submit</button>
                                        </div>


                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            &nbsp;
                        </div>
                    </div>
                </div>
                <div class="col">

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
