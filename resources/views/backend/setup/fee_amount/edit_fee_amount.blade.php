@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Fee Amount</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('fee.amount.update', $editData[0]->fee_category_id) }}"
                                method="POST">
                                @csrf
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Fee Category <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="fee_category_id" id="select" required
                                                        class="form-control">
                                                        <option value="" selected disabled>Select Fee Category
                                                            @foreach ($fee_categories as $feeCategory )
                                                        </option>
                                                        <option value="{{ $feeCategory->id }}"
                                                            {{ ($editData['0']->fee_category_id== $feeCategory->id) ? 'selected' : '' }}>
                                                            {{ $feeCategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($editData as $edit )
                                    <div class="delete-whole-extra-item-add" id="delete-whole-extra-item-add">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <h5>Student Classes <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="class_id[]" id="select" required
                                                            class="form-control">
                                                            <option value="" selected disabled>Select Student Class
                                                                @foreach ($classes as $studentClass )
                                                            </option>
                                                            <option value="{{ $studentClass->id }}"
                                                                {{ ($edit->class_id == $studentClass->id) ? 'selected' :  '' }}>
                                                                {{ $studentClass->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <h5>Fee Amount <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="amount[]" value="{{ $edit->amount }}"
                                                            class="form-control"> </div>
                                                    @error('name')
                                                    <span class="text-danger mt-1 ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-4">
                                                <span class="btn btn-success addeventmore "><i
                                                        class="fa fa-plus-circle"></i></span>
                                                <span class="btn btn-danger removeeventmore "><i
                                                        class="fa fa-minus-circle"></i></span>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
<div style="visibility: hidden">
    <div class="whole-extra-item-add" id="whole-extra-item-add">
        <div class="delete-whole-extra-item-add" id="delete-whole-extra-item-add">
            <div class="form-row">
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Student Classes <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="class_id[]" id="select" required class="form-control">
                                <option value="" selected disabled>Select Student Class
                                    @foreach ($classes as $studentClass )
                                </option>
                                <option value="{{ $studentClass->id }}">
                                    {{ $studentClass->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Fee Amount <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="amount[]" class="form-control"> </div>
                        @error('name')
                        <span class="text-danger mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 mt-4">
                    <span class="btn btn-success addeventmore "><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore "><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;
        $(document).on('click', '.addeventmore', function () {
            var wholeItemAdd = $('#whole-extra-item-add').html();
            $(this).closest('.add_item').append(wholeItemAdd);
            counter++;
        });
        $(document).on('click', '.removeeventmore', function (event) {
            $(this).closest('.delete-whole-extra-item-add').remove();
            counter -= 1;
        })
    })

</script>

@endsection
