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
                            <h3 class="box-title">Assign Subject List</h3>
                            <a href="{{ route('assign.subject.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Assign Subject</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Assign Subject</th>
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $index => $assign )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $assign['studentClass']['name'] }}</td>
                                            <td style="display:flex; justify-content:space-between">
                                                <a href="{{ route('assign.subject.edit', $assign->class_id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('assign.subject.details', $assign->class_id) }}"
                                                    class="btn btn-primary">Details</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection
