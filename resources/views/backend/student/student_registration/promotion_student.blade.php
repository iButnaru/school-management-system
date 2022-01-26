@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Student Promotion</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('student.assignation.promotion.update', $editData->student_id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editData->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="year_id" required class="form-control">
                                                    <option value="" selected disabled>Select Year</option>
                                                    @foreach ($years as $year )
                                                    <option value="{{ $year->id }}"
                                                        {{ $editData['assignedYear']['name'] ==$year->name ? 'selected' : '' }}>
                                                        {{ $year->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" required class="form-control">
                                                    <option value="" selected disabled>Select Class</option>
                                                    @foreach ( $classes as $class )
                                                    <option value="{{ $class->id }}"
                                                        {{ $editData['assignedClass']['name'] == $class->name ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Discount<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" value="{{ $editData['discount']['discount'] }}"
                                                    name="discount" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Group<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="group_id" required class="form-control">
                                                    <option value="" selected disabled>Select Group</option>
                                                    @foreach ($groups as $group )
                                                    <option value="{{ $group->id }}"
                                                        {{ $editData['assignedGroup']['name'] == $group->name ? 'selected' : '' }}>
                                                        {{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Shift<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="shift_id" required class="form-control">
                                                    <option value="" selected disabled>Select Shft</option>
                                                    @foreach ($shifts as $shift )
                                                    <option value="{{ $shift->id }}"
                                                        {{ $editData['assignedShift']['name'] == $shift->name ? 'selected' : '' }}>
                                                        {{ $shift->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-xs-right">
                                        <input type="submit" class="btn btn-info btn-rounded mb-5" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })

</script>
@endsection
