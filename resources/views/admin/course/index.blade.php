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
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0 font-weight-bold text-warning">COURSE LIST</h5>
                                    <a class="btn btn-warning" href="{{ route('course.add') }}"><i
                                            class="bi bi-plus-circle"></i>&nbsp;&nbsp;Add new course</a>
                                </div>
                            </h4>
                            @include('shared.success')
                            @include('shared.error')
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead class="bg-warning text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Course</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($courses as $index => $row)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $row->course_name }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td class="text-end">
                                                    <div class="d-flex">
                                                        <a href="{{ route('course.edit', $row->id) }}"
                                                            class="btn text-success"><i class="bi bi-pencil"></i></a>

                                                        <form id="deleteForm_{{ $row->id }}"
                                                            action="{{ route('course.destroy', $row->id) }}" method="POST">
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
        if (confirm('Are you sure you want to delete this course?')) {
            document.getElementById('deleteForm_' + itemId).submit();
        }
    }
</script>
