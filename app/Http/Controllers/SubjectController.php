<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function viewSubject()
    {
        $data['allData'] = Subject::all();
        return view('backend/setup/subject/view_subject', $data);
    }

    public function getAddSubject()
    {
        return view('backend/setup/subject/add_subject');
    }


    public function storeSubject(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:subjects'
        ]);
        $subject =  new Subject();
        $subject->name = $request->name;
        $subject->save();
        $notification = array(
            'message' => 'Subject has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('subject.view')->with($notification);
    }



    public function editSubject(Subject $subject)
    {
        return view('backend/setup/subject/edit_subject', compact('subject'));
    }

    public function updateSubject(Subject $subject, Request $request)
    {
        $validateData =  $request->validate([
            'name' => 'required|unique:subjects'
        ]);
        $subject->name = $request->name;
        $subject->update();
        $notification = array(
            'message' => 'Subject has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('subject.view')->with($notification);
    }
    public function deleteSubject(Subject $subject)
    {
        $subject->delete();
        $notification = array(
            'message' => 'Subject has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('subject.view')->with($notification);
    }
}
