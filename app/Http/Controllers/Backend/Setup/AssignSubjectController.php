<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function viewAssignSubject()
    {

        // $data['allData'] = AssignSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();

        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    public function getAddAssignSubject()
    {
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }

    public function storeAssignSubject(Request $request)
    {
        $validateData = $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'full_mark' => 'required',
            'pass_mark' => 'required',
            'subjective_mark' => 'required'
        ]);
        $count = count($request->subject_id);
        if ($count) {
            for ($i = 0; $i < $count; $i++) {
                $assignSubject = new AssignSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $request->subject_id[$i];
                $assignSubject->full_mark = $request->full_mark[$i];
                $assignSubject->pass_mark = $request->pass_mark[$i];
                $assignSubject->subjective_mark = $request->subjective_mark[$i];
                $assignSubject->save();
            }
            $notification = array(
                'message' => 'Subjects have been assigned to classes.',
                'alert-type' => 'success'
            );
            return redirect()->route('assign.subject.view')->with($notification);
        }
        $notification = array(
            'message' => 'You must add at least one subject',
            'alert-type' => 'error'
        );
        return $notification;
    }

    public function editAssignSubject($classId)
    {
        $data['assignSubjectModels'] = AssignSubject::where('class_id', $classId)->orderBy('subject_id', 'asc')->get();
        $data['subjects'] = Subject::all();
        $data['studentClass'] = StudentClass::all();

        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }

    public function updateAssignSubject(Request $request, $classId)
    {
        if (!$request->subject_id) {
            $notification = array(
                'message' => 'You must select at least one subject',
                'alert-type' => 'error'
            );
            return redirect()->route('assign.subject.edit', $classId)->with($notification);
        } else {
            AssignSubject::where('class_id', $classId)->delete();
            for ($i = 0; $i < $request->subject_id; $i++) {
                $assignSubject = new AssignSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $request->subject_id[$i];
                $assignSubject->full_mark = $request->full_mark[$i];
                $assignSubject->pass_mark = $request->pass_mark[$i];
                $assignSubject->subjective_mark = $request->subjective_mark[$i];
                $assignSubject->save();
            }
            $notification = array(
                'message' => 'The assigned subjects have been ',
                'alert-type' => 'success'
            );
            return redirect()->route('assign.subject.view')->with($notification);
        }
    }

    public function detailsAssignSubject($classId)
    {
        $data['detailsData'] = AssignSubject::where('class_id', $classId)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.details_assign_subject', $data);
    }
}
