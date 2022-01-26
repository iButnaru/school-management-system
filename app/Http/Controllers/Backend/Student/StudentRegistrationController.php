<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentRegistrationController extends Controller
{

    public function viewStudentAssignation()
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['year_id'] = StudentYear::orderBy('id', 'desc')->first()->id;
        $data['class_id'] = StudentYear::orderBy('id', 'desc')->first()->id;
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student_registration.view_student', $data);
    }


    public function getAddStudentAssignation()
    {
        $data['students'] = User::all();
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_registration.add_student', $data);
    }

    public function  storeStudentRegistration(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('user_type', 'student')->orderBy('id', 'desc')->first();
            if (!$student) {
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } else if ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } else if ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            } else {
                $student = User::where('user_type', 'student')->orderBy('id', 'desc')->first()->id;
                $studentId = $student +  1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } else if ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } else if ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            }

            $finalIdNumber = $checkYear . $id_no;
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_number = $finalIdNumber;
            $user->password = bcrypt($code);
            $user->user_type = 'student';
            $user->code = $code;
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->date_ob =  date('Y-m-d', strtotime($request->date_ob));
            $user->religion = $request->religion;
            $old_photo = $request->old_photo;
            if ($request->file('profile_photo_path')) {
                $new_photo = $request->file('profile_photo_path')->store('profile-photos', 'public');
                $user->profile_photo_path =  $new_photo;
            };
            $user->save();

            $assignStudent = new AssignStudent();
            $assignStudent->student_id = $user->id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->class_id = $request->class_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discountStudent = new DiscountStudent();
            $discountStudent->assign_student_id = $assignStudent->id;
            $discountStudent->fee_category_id = 1;
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });
        $notification = array(
            'message' => 'Student registration inserted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.assignation.view')->with($notification);
    }

    public function search(Request $request)
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.student_registration.view_student', $data);
    }

    public function editStudentAssignation($studentId)
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['editData'] =  AssignStudent::with(['assignedStudent', 'discount'])->where('student_id', $studentId)->first();
        return view('backend.student.student_registration.edit_student', $data);
    }

    public function  updateStudentAssignation(Request $request, $studentId)
    {
        DB::transaction(function () use ($request, $studentId) {
            $user = User::where('id', $studentId)->first();
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->date_ob =  date('Y-m-d', strtotime($request->date_ob));
            $user->religion = $request->religion;
            $old_photo = $request->old_photo;
            if ($request->file('profile_photo_path')) {
                @unlink('storage/' .  $old_photo);
                $new_photo = $request->file('profile_photo_path')->store('profile-photos', 'public');
                $user->profile_photo_path =  $new_photo;
            };
            $user->update();
            $assignStudent =  AssignStudent::where('id', $request->id)->where('student_id', $studentId)->first();
            $assignStudent->year_id = $request->year_id;
            $assignStudent->class_id = $request->class_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->update();

            $discountStudent = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discountStudent->discount = $request->discount;
            $discountStudent->update();
        });
        $notification = array(
            'message' => 'Student registration updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.assignation.view')->with($notification);
    }

    public function editStudentPromotion($studentId)
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['editData'] =  AssignStudent::with(['assignedStudent', 'discount'])->where('student_id', $studentId)->first();
        return view('backend.student.student_registration.promotion_student', $data);
    }
    public function updateStudentPromotion(Request $request, $studentId)
    {
        DB::transaction(function () use ($request, $studentId) {

            $assignStudent =  new AssignStudent();
            $assignStudent->student_id = $studentId;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->class_id = $request->class_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discountStudent = new DiscountStudent();
            $discountStudent->assign_student_id = $assignStudent->id;
            $discountStudent->fee_category_id = '1';
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });
        $notification = array(
            'message' => 'Student promotion updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('student.assignation.view')->with($notification);
    }
}
