@extends('layouts.admin.index')
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
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productModal"><i
                                            class="bi bi-plus-circle"></i>&nbsp;&nbsp;Add new course</button>
                                </div>
                            </h4>
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

                                        </tr>
                                    </tfoot>
                                    <tbody>

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
