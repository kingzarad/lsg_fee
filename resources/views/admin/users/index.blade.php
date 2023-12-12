@extends('layouts.index')
@section('content')
    <div class="page-wrapper dashboard">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text">Students</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard/Students</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0 font-weight-bold text-warning">STUDENTS LIST</h5>

                                </div>
                            </h4>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead class="bg-warning text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>ID NUMBER</th>
                                            <th>NAME</th>
                                            <th>COURSE</th>
                                            <th>YEAR LEVEL</th>
                                            <th>SEX</th>
                                            <th>CREATED AT</th>

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
                                        @foreach ($students as $index => $row)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $row->id_number }}</td>
                                                <td>{{ $row->fname . ' ' . $row->lname . ' ' . $row->mname }}</td>
                                                <td>
                                                    @foreach ($courses as $item)
                                                        @if ($row->id == $item->id)
                                                            {{ $item->course_name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $row->year_level }}</td>
                                                <td>{{ $row->sex }}</td>
                                                <td>{{ $row->created_at }}</td>
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
