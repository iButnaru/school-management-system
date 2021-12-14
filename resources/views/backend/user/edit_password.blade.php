@extends('admin.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Change Your Password</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-group">
                                            <h5>Current Password<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" id="current_password" name="old_password"
                                                    class="form-control">
                                                @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>New Password<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" id="password" name="password"
                                                    class="form-control">
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <h5>Confirm Password<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control">
                                                @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
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

@endsection
