@extends('layouts.index')
@section('content')
    <div class="container pt-4">
        <div class="row page-titles">
            <div class="col-md-5 d-flex justify-content-between w-100">
                <h3 class="text"><strong>Payment Form</strong></h3>
                <a href="{{ route('users.home') }}" class="btn btn-warning btn-sm mt-1 text-white">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body m-3">
                        <div class="pt-4 mb-3">
                            <small class="card-title text-left pb-0 fs-4">
                                Pay through gcash
                            </small>
                        </div>
                        @include('shared.success')
                        @include('shared.error')
                        <form action="{{ route('fees.payformupdate', $fees->id) }}" method="POST" class="row g-3"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <label for="file" class="form-label"><strong>Fee Type: &nbsp;</strong></label>
                                    <input type="text" value="{{ ucfirst($fees->fee_type) }}" disabled>

                                </div>
                                <div class="mb-3">
                                    <label for="ufile" class="form-label"><strong>Amount: &nbsp;</strong></label>
                                    <input type="text" value="₱ {{ $fees->amount }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="ufile" class="form-label"><strong>Select receipt to
                                            upload:</strong></label>
                                    <p>File Type: .jpg, .jpeg, .png</p>
                                    <input type="file" name="receipt" id="receipt" class="form-control"
                                        accept=".jpg,.jpeg,.png">
                                    @error('receipt')
                                        <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="mt-3 btn btn-dark w-100" type="submit">Pay Now</button>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
            <div class="col"></div>

        </div>
    </div>
@endsection
