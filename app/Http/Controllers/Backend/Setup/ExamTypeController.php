<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function viewExamType()
    {
        $data['allData'] = ExamType::all();
        return view('backend/setup/exam_type/view_exam_type', $data);
    }

    public function getAddExamType()
    {
        return view('backend/setup/exam_type/add_exam_type');
    }

    public function storeAddExamType(Request $request)
    {
        $examType = new ExamType();
        $examType->name = $request->name;
        $examType->save();
        $data['allData'] = ExamType::all();
        $notification = array(
            'message' => 'Exam Type has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }

    public function editAddExamType(ExamType $examType)
    {
        return view('backend/setup/exam_type/edit_exam_type', compact('examType'));
    }

    public function updateAddExamType(ExamType $examType, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types'
        ]);
        $examType->name = $request->name;
        $examType->update();
        $notification = array(
            'message' => 'Exam Type has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }

    public function deleteAddExamType(ExamType $examType)
    {
        $examType->delete();
        $notification = array(
            'message' => 'Exam Type has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
}
