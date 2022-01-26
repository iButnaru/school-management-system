<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function viewYear()
    {
        $data['allData'] = StudentYear::all();
        return view('backend.setup.student_year.view_year', $data);
    }

    public function getAddYear()
    {
        return view('backend.setup.student_year.add_year');
    }

    public function storeStudentYear(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_years',
        ]);

        $studentYear = new StudentYear([
            'name' => $request->name,
        ]);
        $studentYear->save();
        $notification = array(
            'message' => 'Student Year has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }

    public function editStudentYear(StudentYear $studentYear)
    {
        return view('backend.setup.student_year.edit_year', compact('studentYear'));
    }



    public function updateStudentYear(StudentYear $studentYear, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_years',
        ]);

        $studentYear->name = $request->name;
        $studentYear->update();
        $notification = array(
            'message' => 'Student Year has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }

    public function deleteStudentYear(StudentYear $studentYear)
    {
        $studentYear->delete();
        $notification = array(
            'message' => 'Student Year has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
}
