@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title"><strong>Search</strong></h4>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('student.year.class.search') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="year_id" required class="form-control">
                                                    <option value="" selected disabled>Select Year</option>
                                                    @foreach ($years as $year )
                                                    <option value="{{ $year->id }}"
                                                        {{ ($year->id == @$year_id) ? 'selected' : ''}}>
                                                        {{ $year->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="class_id" required class="form-control">
                                                    <option value="" selected disabled>Select Class</option>
                                                    @foreach ( $classes as $class )
                                                    <option value="{{ $class->id }}"
                                                        {{ ($class->id == @$class_id) ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="padding-top:25px">
                                        <input class="btn btn-rounded btn-dark mb-5" type="submit" name="search"
                                            value="search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assigned Students List</h3>
                            <a href="{{ route('student.registration.add') }}" class="btn btn-success btn-rounded"
                                style=" float: right;">Add Student Assignation</a>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                @if(!@$search)
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Name</th>
                                            <th>ID Number</th>
                                            <th>Roll</th>
                                            <th>Class</th>
                                            <th>Year</th>
                                            <th>Group</th>
                                            <th>Shift</th>
                                            <th>Image</th>
                                            @if(Auth::user()->role =='admin')
                                            <th>Code</th>
                                            @endif
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $index => $assignedStudent )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $assignedStudent['assignedStudent']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedStudent']['id_number'] }}</td>
                                            <td>{{ $assignedStudent->roll }}</td>
                                            <td>{{ $assignedStudent['assignedClass']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedYear']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedGroup']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedShift']['name'] }}</td>
                                            <td><img style="border-radius: 50%; width:40px" src="{{ !empty($assignedStudent['assignedStudent']['profile_photo_path'])
                                                    ? asset('storage/'. $assignedStudent['assignedStudent']['profile_photo_path'])
                                                    : asset('storage/default\no_image.jpg')}}">
                                            </td>
                                            @if(Auth::user()->role == 'admin')
                                            <td>{{ $assignedStudent['assignedStudent']['code'] }}</td>
                                            @endif
                                            <td style="display:flex; justify-content:space-between">
                                                <a href="{{ route('student.assignation.edit', $assignedStudent->student_id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('student.assignation.promotion.edit',$assignedStudent->student_id) }}"
                                                    class="btn btn-danger">Promote</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @else
                                {{-- Search tableee --}}
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SL</th>
                                            <th>Name</th>
                                            <th>ID Number</th>
                                            <th>Roll</th>
                                            <th>Class</th>
                                            <th>Year</th>
                                            <th>Group</th>
                                            <th>Shift</th>
                                            <th>Image</th>
                                            @if(Auth::user()->role =='admin')
                                            <th>Code</th>
                                            @endif
                                            <th style="width: 25%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $index => $assignedStudent )
                                        <tr>
                                            <td>{{ 1+$index  }}</td>
                                            <td>{{ $assignedStudent['assignedStudent']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedStudent']['id_number'] }}</td>
                                            <td>{{ $assignedStudent->roll }}</td>
                                            <td>{{ $assignedStudent['assignedClass']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedYear']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedGroup']['name'] }}</td>
                                            <td>{{ $assignedStudent['assignedShift']['name'] }}</td>
                                            <td><img style="border-radius: 50%; width:40px" src="{{ !empty($assignedStudent['assignedStudent']['profile_photo_path'])
                                                    ? asset('storage/'. $assignedStudent['assignedStudent']['profile_photo_path'])
                                                    : asset('storage/default\no_image.jpg')}}">
                                            </td>
                                            @if(Auth::user()->role == 'admin')
                                            <td>{{ $assignedStudent['assignedStudent']['code'] }}</td>
                                            @endif
                                            <td style="display:flex; justify-content:space-between">
                                                <a href="{{ route('student.assignation.edit',  $assignedStudent->student_id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('student.assignation.promotion.edit',$assignedStudent->student_id) }}"
                                                    class="btn btn-danger">Promote</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
