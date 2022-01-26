@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fee Amount Details</h3>
                            <a href="{{ route('fee.amount.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Fee Amount</a>
                        </div>
                        <div class="box-body">
                            <h4 class="mb-3"><strong>Fee Category :</strong>
                                {{ $detailsData['0']['feeCategory']['name'] }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Class Name</th>
                                            <th style="width: 25%">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailsData as $index => $details )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $details['studentClass']['name'] }}</td>
                                            <td style="display:flex; justify-content:space-between">
                                                {{ $details->amount}}
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
