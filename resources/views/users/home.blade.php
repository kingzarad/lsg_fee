@extends('layouts.index')
@section('content')
    <div class="container pt-4">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text"><strong>Payment List</strong></h3>
            </div>
        </div>
        @include('shared.success')
                        @include('shared.error')
        <div class="row">
            @forelse  ($fees_list as $row)
                @if ($row->users_id == Auth::guard('students')->user()->id)
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-title ">
                                STATUS: <span
                                    class="badge p-2 bg-{{ $row->status === 'paid' ? 'success' : ($row->status === 'unpaid' ? 'danger' : 'warning') }} ">
                                    <strong>{{ Str::upper($row->status) }}</strong></span>
                            </div>
                            <p class="card-text p-2">
                                <strong>Name:
                                    @foreach ($students as $data)
                                        @if ($row->users_id == $data->id)
                                            {{ Str::ucfirst($data->fname) . ' ' . Str::ucfirst($data->lname) . ' ' . Str::ucfirst($data->mname) }}
                                        @endif
                                    @endforeach
                                </strong> <br><br>
                                <strong>Fee Type: <span
                                        class="text-info">{{ Str::upper($row->fee_type) }}</span></strong><br>
                                <strong>Amount: ₱ {{ $row->amount }}</strong> <br><br>
                                <strong>Due Date: {{ $row->due_date }}</strong>
                            </p>
                            @if ($row->status != 'pending' && $row->status != 'paid')
                            <a href="{{ route('fees.payform', $row->id) }}" class="btn btn-sm btn-primary">Pay Now</a>
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <p>No records found</p>
            @endforelse

        </div>
    </div>
@endsection
