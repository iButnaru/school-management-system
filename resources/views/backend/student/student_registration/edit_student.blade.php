@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Student</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('student.registration.update', $editData->student_id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editData->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Student Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" value="{{ $editData['assignedStudent']['name'] }}"
                                                    name="name" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Father`a name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="father_name"
                                                    value="{{ $editData['assignedStudent']['father_name'] }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mother`a name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text"
                                                    value="{{ $editData['assignedStudent']['mother_name'] }}"
                                                    name="mother_name" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Phone Number<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" value="{{ $editData['assignedStudent']['phone'] }}"
                                                    name="phone" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Address<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" value="{{ $editData['assignedStudent']['address'] }}"
                                                    name="address" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" id="gender" required class="form-control">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="male"
                                                        {{ $editData['assignedStudent']['gender']== 'male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="female"
                                                        {{ $editData['assignedStudent']['gender'] == 'female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of birth<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" value="{{ $editData['assignedStudent']['date_ob'] }}"
                                                    name="date_ob" class="form-control" required> </div>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Religion<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="religion" id="religion" required class="form-control">
                                                    <option value="" disabled>Select Religion</option>
                                                    <option value="Christian"
                                                        {{ $editData['assignedStudent']['religion'] == 'Christian' ? 'selected' : '' }}>
                                                        Christian</option>
                                                    <option value="Hindu"
                                                        {{ $editData['assignedStudent']['religion'] == 'Hindu' ? 'selected' : '' }}>
                                                        Hindu</option>
                                                    <option value="Islam"
                                                        {{ $editData['assignedStudent']['religion'] == 'Islam' ? 'selected' : '' }}>
                                                        Islam</option>
                                                    <option value="Other"
                                                        {{ $editData['assignedStudent']['religion'] == 'Other' ? 'selected' : '' }}>
                                                        Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                </div>
                                <div class="row">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Upload new picture</h5>
                                            <div class="controls">
                                                <div class="controls">
                                                    <input type="file" name="profile_photo_path" class="form-control"
                                                        id="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="hidden" name="old_photo"
                                                    value="{{ $editData['assignedStudent']['profile_photo_path']}}">
                                                <img id="showImage" class="rounded-circle"
                                                    style="width: 80px; border: 3px solid rgb(46, 20, 138);"
                                                    src="{{ !empty($editData['assignedStudent']['profile_photo_path']) ? asset('storage/'. $editData['assignedStudent']['profile_photo_path'])  :  url('storage/default\no_image.jpg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-info btn-rounded mb-5" value="Update">
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
