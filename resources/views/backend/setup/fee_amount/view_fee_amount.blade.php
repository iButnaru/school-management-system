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
                            <h3 class="box-title">Fee Amount List</h3>
                            <a href="{{ route('fee.amount.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Fee Amount</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Fee Category</th>
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $index => $feeAmount )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $feeAmount['feeCategory']['name'] }}</td>
                                            <td style="display:flex; justify-content:space-between">
                                                <a href="{{ route('fee.amount.edit', $feeAmount->fee_category_id ) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('fee.amount.details', $feeAmount->fee_category_id) }}"
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
