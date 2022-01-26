@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Subject</h3>
                            <a href="{{ route('subject.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Subject</a>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Subject Name</th>
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $index => $subject )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td style="display:flex; justify-content:space-between">
                                                <a href="{{ route('subject.edit', $subject ) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('subject.delete', $subject) }}" class="btn btn-danger"
                                                    id="delete">Delete</a>
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
