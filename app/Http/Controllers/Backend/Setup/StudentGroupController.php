<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function viewStudentGroup()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student_group.view_group', $data);
    }

    public function getAddGroup()
    {
        return view('backend.setup.student_group.add_group');
    }

    public function storeStudentGroup(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups'
        ]);

        $studentGroup = new StudentGroup([
            'name' => $request->name,
        ]);
        $studentGroup->save();

        $notification = array(
            'message' => 'Student Group has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }

    public function editStudentGroup(StudentGroup $studentGroup)
    {
        return view('backend.setup.student_group.edit_group', compact('studentGroup'));
    }

    public function updateStudentGroup(StudentGroup $studentGroup, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups'
        ]);

        $studentGroup->name = $request->name;
        $studentGroup->update();
        $notification = array(
            'message' => 'Student Group has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }

    public function deleteStudentGroup(StudentGroup $studentGroup)
    {
        $studentGroup->delete();
        $notification = array(
            'message' => 'Student Group has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
}
