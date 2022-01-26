<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function viewStudentShift()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.student_shift.view_shift', $data);
    }

    public function getAddShift()
    {
        return view('backend.setup.student_shift.add_shift');
    }

    public function storeStudentShift(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts'
        ]);
        $studentShift = new StudentShift([
            'name' => $request->name,
        ]);
        $studentShift->save();

        $notification = array(
            'message' => 'Student Shift has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }

    public function editStudentShift(StudentShift $studentShift)
    {
        return view('backend.setup.student_shift.edit_shift', compact('studentShift'));
    }

    public function updateStudentShift(StudentShift $studentShift, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts'
        ]);

        $studentShift->name = $request->name;
        $studentShift->update();
        $notification = array(
            'message' => 'Student Shift has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }


    public function deleteStudentShift(StudentShift $studentShift)
    {
        $studentShift->delete();
        $notification = array(
            'message' => 'Student Shift has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
}
