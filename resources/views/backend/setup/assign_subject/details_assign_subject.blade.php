@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assigned Subjects Details</h3>
                            <a href="{{ route('assign.subject.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Fee Amount</a>
                        </div>
                        <div class="box-body">
                            <h4 class="mb-3"><strong>Class Name :</strong>
                                {{ $detailsData['0']['studentClass']['name'] }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%; text-align:center">SL</th>
                                            <th style="width: 25%;  text-align: center">Assigned Subjects </th>
                                            <th style="width: 15%; text-align:center">Full Mark</th>
                                            <th style="width: 15%; text-align:center">Pass Mark</th>
                                            <th style="width: 15%; text-align:center">Subjective Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailsData as $index => $details )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td style="text-align:center">{{ $details['studentSubject']['name'] }}</td>
                                            <td style="text-align:center ">
                                                {{ $details->full_mark}}
                                            </td>
                                            <td style="text-align:center">
                                                {{ $details->pass_mark}}
                                            </td>
                                            <td style="text-align:center">
                                                {{ $details->subjective_mark}}
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
