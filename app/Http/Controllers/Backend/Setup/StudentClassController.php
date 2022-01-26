<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function viewStudentClass()
    {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    public function getAddStudent()
    {
        return view('backend.setup.student_class.add_student');
    }
    public function storeStudent(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes',
        ]);

        $studentClass = new StudentClass([
            'name' => $request->name,
        ]);
        $studentClass->save();

        $notification = array(
            'message' => 'Student Class has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    public function editStudentClass(StudentClass $studentClass)
    {

        return view('backend.setup.student_class.edit_class', compact('studentClass'));
    }

    public function updateStudentClass(StudentClass $studentClass, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes',
        ]);
        $studentClass->name = $request->name;
        $studentClass->update();
        $notification = array(
            'message' => 'Student Class has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    public function deleteStudentClass(StudentClass $studentClass)
    {
        $studentClass->delete();
        $notification = array(
            'message' => 'Student Class has deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
