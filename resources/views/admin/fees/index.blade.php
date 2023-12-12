@extends('layouts.index')
@section('content')
    <div class="page-wrapper dashboard">
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
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0 font-weight-bold text-warning">COLLEGE FEES LIST</h5>
                                    <a class="btn btn-warning" href="{{ route('fees.add') }}"><i
                                            class="bi bi-plus-circle"></i>&nbsp;&nbsp;Add new fee</a>
                                </div>
                            </h4>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead class="bg-warning text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>STUDENT ACCOUNT</th>
                                            <th>FEE TYPE</th>
                                            <th>AMOUNT</th>
                                            <th>DUE DATE</th>
                                            <th>STATUS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($fees_list as $index => $row)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @foreach ($students as $data)
                                                        @if ($row->users_id == $data->id)
                                                            {{ $data->fname . ' ' . $data->lname . ' ' . $data->mname }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $row->fee_type }}</td>
                                                <td><strong>{{ $row->amount }}</strong></td>
                                                <td>{{ $row->due_date }}</td>
                                                <td
                                                    class="text-{{ $row->status === 'paid' ? 'success' : ($row->status === 'unpaid' ? 'danger' : 'warning') }}">
                                                    <strong> {{ $row->status }}</strong>
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex">
                                                        @if ($row->proof_payment != '' && $row->status != 'paid')
                                                            <a href="{{ route('fees.payment', $row->id) }}"
                                                                class="btn text-info"><i class="bi bi-eye"></i></a>
                                                        @endif
                                                        @if ($row->status != 'paid')
                                                            <a href="{{ route('fees.edit', $row->id) }}"
                                                                class="btn text-success"><i class="bi bi-pencil"></i></a>
                                                        @endif
                                                        <form id="deleteForm_{{ $row->id }}"
                                                            action="{{ route('fees.destroy', $row->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn text-danger"
                                                                onclick="confirmAndSubmit('{{ $row->id }}')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmAndSubmit(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('deleteForm_' + itemId).submit();
        }
    }
</script>
