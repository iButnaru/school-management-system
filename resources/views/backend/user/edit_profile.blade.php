@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Update User</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('profile.update', $user) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Role <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="user_type" id="select" class="form-control">
                                                            <option value="" selected disabled>Select Role</option>
                                                            <option value="admin"
                                                                {{ $user->user_type== 'admin' ? "selected" : "" }}>Admin
                                                            </option>
                                                            <option value="user"
                                                                {{ $user->user_type == 'user' ? "selected" : "" }}>User
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" value="{{ $user->name }}"
                                                            class="form-control"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Email Field <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email" value="{{ $user->email }}"
                                                            class="form-control" required> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Phone Number <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                                            class="form-control"> </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Address <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="address" value="{{ $user->address }}"
                                                            class="form-control"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Gender <span class="text-danger">*</span></h5>
                                                    <select name="gender" id="select" class="form-control">
                                                        <option value="" selected disabled>Please select gender</option>
                                                        <option value="male"
                                                            {{ $user->gender == 'male' ? 'required' : '' }}>Male
                                                        </option>
                                                        <option value="female"
                                                            {{ $user->gender == 'female' ? 'required' : '' }}>Female
                                                        </option>
                                                        <option value="other"
                                                            {{ $user->gender =='other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Status <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="status" value="{{ $user->status }}"
                                                            class="form-control"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="text-center text-warning">Update image </h5>
                                                <div style="display: flex">
                                                    <div class="col-6 form-group">
                                                        <input type="hidden" name="old_photo"
                                                            value="{{ $user->profile_photo_path }}">
                                                        <div class="widget-user-image">
                                                            <img id="showImage" class="rounded-circle"
                                                                style="width: 100px"
                                                                src="{{ !empty($user->profile_photo_path) ? asset('storage/' . $user->profile_photo_path) : 'storage/default\no_image.jpg' }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <label for="profile_photo_path">Upload your new image</label>
                                                        <input name="profile_photo_path" type="file" id="image">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-info btn-rounded mb-5" value="Submit">
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
