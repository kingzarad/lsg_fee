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
                                        <h5 class="card-title text-left pb-0 fs-4">Pending College Fees</h5>
                                    </div>
                                    @include('shared.success')
                                    @include('shared.error')
                                    <form action="{{ route('fees.paymentupdate', $fees->id) }}" method="POST"
                                        class="row g-3">
                                        @method('PUT')
                                        @csrf
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="ufile" class="form-label"><strong>Payment
                                                        Receipt:</strong></label>
                                                <img src="{{ asset('storage/uploads/' . $fees->proof_payment) }}"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <button class=" mt-3 btn btn-danger w-100" type="submit">Approve</button>
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
