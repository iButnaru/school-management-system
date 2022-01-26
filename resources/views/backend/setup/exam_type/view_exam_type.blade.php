@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Exam Type</h3>
                            <a href="{{ route('exam.type.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Exam Type</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Exam Type Name</th>
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $index => $examType )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $examType->name }}</td>
                                            <td style="display:flex; justify-content:space-between">
                                                <a href="{{ route('exam.type.edit', $examType ) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('exam.type.delete', $examType) }}"
                                                    class="btn btn-danger" id="delete">Delete</a>
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
        </section>
    </div>
</div>

@endsection
