<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\backend\setup\FeeAmountController;
use App\Http\Controllers\backend\setup\FeeCategoryController;
use App\Http\Controllers\backend\setup\StudentYearController;
use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\setup\StudentGroupController;
use App\Http\Controllers\backend\setup\StudentShiftController;
use App\Http\Controllers\Backend\Student\StudentRegistrationController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\SubjectController;
use App\Models\FeeCategory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//User management all routes
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'viewUsers'])->name('users.view');
    Route::get('/add', [UserController::class, 'getAddUser'])->name('user.add');
    Route::post('/store', [UserController::class, 'storeUser'])->name('user.store');
    Route::get('/edit/{user}', [UserController::class, 'getEdit'])->name('user.edit');
    Route::post('/update/{user}', [UserController::class, 'updateUser'])->name('user.update');
    Route::get('/delete/{user}', [UserController::class, 'deleteUser'])->name('user.delete');
});

//User profile & change password
Route::prefix('profile')->group(function () {
    Route::get('/view/profile', [ProfileController::class,  'viewProfile'])->name('profile.view');
    Route::get('/edit/profile/{user}', [ProfileController::class,  'editProfile'])->name('profile.edit');
    Route::post('/update/profile/{user}', [ProfileController::class,  'updateProfile'])->name('profile.update');
    Route::get('/password/view', [ProfileController::class,  'viewPassword'])->name('password.view');
    Route::post('/password/update', [ProfileController::class,  'updatePassword'])->name('password.update');
});


//Student class Routes
Route::prefix('setups')->group(function () {
    Route::get('/student', [StudentClassController::class, 'viewStudentClass'])->name('student.class.view');
    Route::get('/student/add', [StudentClassController::class, 'getAddStudent'])->name('student.class.add');
    Route::post('/student/store', [StudentClassController::class, 'storeStudent'])->name('student.class.store');
    Route::get('/student/edit/{studentClass}', [StudentClassController::class, 'editStudentClass'])->name('student.class.edit');
    Route::post('/student/update/{studentClass}', [StudentClassController::class, 'updateStudentClass'])->name('student.class.update');
    Route::get('/student/delete/{studentClass}', [StudentClassController::class, 'deleteStudentClass'])->name('student.class.delete');

    //Student year routes
    Route::get('/student/year/view', [StudentYearController::class, 'viewYear'])->name('student.year.view');
    Route::get('/student/year/add', [StudentYearController::class, 'getAddYear'])->name('student.year.add');
    Route::post('/student/year/store', [StudentYearController::class, 'storeStudentYear'])->name('student.year.store');
    Route::get('/student/year/edit/{studentYear}', [StudentYearController::class, 'editStudentYear'])->name('student.year.edit');
    Route::post('/student/year/update/{studentYear}', [StudentYearController::class, 'updateStudentYear'])->name('student.year.update');
    Route::get('/student/year/delete/{studentYear}', [StudentYearController::class, 'deleteStudentYear'])->name('student.year.delete');


    //Student group routes
    Route::get('/student/group/view', [StudentGroupController::class, 'viewStudentGroup'])->name('student.group.view');
    Route::get('/student/group/add', [StudentGroupController::class, 'getAddGroup'])->name('student.group.add');
    Route::post('/student/group/store', [StudentGroupController::class, 'storeStudentGroup'])->name('student.group.store');
    Route::get('/student/group/edit/{studentGroup}', [StudentGroupController::class, 'editStudentGroup'])->name('student.group.edit');
    Route::post('/student/group/update/{studentGroup}', [StudentGroupController::class, 'updateStudentGroup'])->name('student.group.update');
    Route::get('/student/group/delete/{studentGroup}', [StudentGroupController::class, 'deleteStudentGroup'])->name('student.group.delete');

    //Student Shift routes
    Route::get('/student/shift/view', [StudentShiftController::class, 'viewStudentShift'])->name('student.shift.view');
    Route::get('student/shift/add', [StudentShiftController::class, 'getAddShift'])->name('student.shift.add');
    Route::post('student/shift/store', [StudentShiftController::class, 'storeStudentShift'])->name('student.shift.store');
    Route::get('student/shift/edit/{studentShift}', [StudentShiftController::class, 'editStudentShift'])->name('student.shift.edit');
    Route::post('student/shift/update/{studentShift}', [StudentShiftController::class, 'updateStudentShift'])->name('student.shift.update');
    Route::get('student/shift/delete/{studentShift}', [StudentShiftController::class, 'deleteStudentShift'])->name('student.shift.delete');

    //Student fee categories
    Route::get('/fee/category/view', [FeeCategoryController::class, 'viewFeeCategory'])->name('fee.category.view');
    Route::get('fee/category/add', [FeeCategoryController::class, 'getAddFee'])->name('fee.category.add');
    Route::post('fee/category/store', [FeeCategoryController::class, 'storeFeeCategory'])->name('fee.category.store');
    Route::get('fee/category/edit/{feeCategory}', [FeeCategoryController::class, 'editFeeCategory'])->name('fee.category.edit');
    Route::post('fee/category/update/{feeCategory}', [FeeCategoryController::class, 'updateFeeCategory'])->name('fee.category.update');
    Route::get('fee/category/delete/{feeCategory}', [FeeCategoryController::class, 'deleteFeeCategory'])->name('fee.category.delete');

    //Student fee category amount
    Route::get('/fee/amount/view', [FeeAmountController::class, 'viewFeeAmount'])->name('fee.amount.view');
    Route::get('fee/amount/add', [FeeAmountController::class, 'getAddFeeAmount'])->name('fee.amount.add');
    Route::post('fee/amount/store', [FeeAmountController::class, 'storeFeeAmount'])->name('fee.amount.store');
    Route::get('fee/amount/edit/{feeCategoryId}', [FeeAmountController::class, 'editFeeAmount'])->name('fee.amount.edit');
    Route::post('fee/amount/update/{feeCategoryId}', [FeeAmountController::class, 'updateFeeAmount'])->name('fee.amount.update');
    Route::get('fee/amount/details/{feeCategoryId}', [FeeAmountController::class, 'detailsFeeAmount'])->name('fee.amount.details');


    //Exam type
    Route::get('exam/type/view', [ExamTypeController::class, 'viewExamType'])->name('exam.type.view');
    Route::get('exam/type/add', [ExamTypeController::class, 'getAddExamType'])->name('exam.type.add');
    Route::post('exam/type/store', [ExamTypeController::class, 'storeAddExamType'])->name('exam.type.store');
    Route::get('exam/type/edit/{examType}', [ExamTypeController::class, 'editAddExamType'])->name('exam.type.edit');
    Route::post('exam/type/update/{examType}', [ExamTypeController::class, 'updateAddExamType'])->name('exam.type.update');
    Route::get('exam/type/delete/{examType}', [ExamTypeController::class, 'deleteAddExamType'])->name('exam.type.delete');

    //Subject
    Route::get('subject/view', [SubjectController::class, 'viewSubject'])->name('subject.view');
    Route::get('subject/add', [SubjectController::class, 'getAddSubject'])->name('subject.add');
    Route::post('subject/store', [SubjectController::class, 'storeSubject'])->name('subject.store');
    Route::get('subject/edit/{subject}', [SubjectController::class, 'editSubject'])->name('subject.edit');
    Route::post('subject/update/{subject}', [SubjectController::class, 'updateSubject'])->name('subject.update');
    Route::get('subject/delete/{subject}', [SubjectController::class, 'deleteSubject'])->name('subject.delete');

    //Assign subject
    Route::get('assign/subject/view', [AssignSubjectController::class, 'viewAssignSubject'])->name('assign.subject.view');
    Route::get('assign/subject/add', [AssignSubjectController::class, 'getAddAssignSubject'])->name('assign.subject.add');
    Route::post('assign/subject/store', [AssignSubjectController::class, 'storeAssignSubject'])->name('assign.subject.store');
    Route::get('assign/edit/{classId}', [AssignSubjectController::class, 'editAssignSubject'])->name('assign.subject.edit');
    Route::post('assign/update/{classId}', [AssignSubjectController::class, 'updateAssignSubject'])->name('assign.subject.update');
    Route::get('assign/details/{classId}', [AssignSubjectController::class, 'detailsAssignSubject'])->name('assign.subject.details');

    //Route designation
    Route::get('designation/view', [DesignationController::class, 'viewDesignation'])->name('designation.view');
    Route::get('designation/add', [DesignationController::class, 'getAddDesignation'])->name('designation.add');
    Route::post('designation/add', [DesignationController::class, 'storeDesignation'])->name('designation.store');
    Route::get('designation/edit/{designation}', [DesignationController::class, 'editDesignation'])->name('designation.edit');
    Route::post('designation/update/{designation}', [DesignationController::class, 'updateDesignation'])->name('designation.update');
    Route::get('designation/delete/{designation}', [DesignationController::class, 'deleteDesignation'])->name('designation.delete');
});

//Student registration routes
Route::prefix('students')->group(function () {
    Route::get('/registration/view', [StudentRegistrationController::class, 'viewStudentAssignation'])->name('student.assignation.view');
    Route::get('/registration/add', [StudentRegistrationController::class, 'getAddStudentAssignation'])->name('student.registration.add');
    Route::post('/registration/store', [StudentRegistrationController::class, 'storeStudentRegistration'])->name('student.registration.store');
    Route::get('/year/class/search', [StudentRegistrationController::class, 'search'])->name('student.year.class.search');
    Route::get('/registration/edit/{studentId}', [StudentRegistrationController::class, 'editStudentAssignation'])->name('student.assignation.edit');
    Route::post('/registration/update/{studentId}', [StudentRegistrationController::class, 'updateStudentAssignation'])->name('student.registration.update');
    Route::get('/student/promotion/edit/{studentId}', [StudentRegistrationController::class, 'editStudentPromotion'])->name('student.assignation.promotion.edit');
    Route::post('/student/promotion/update/{studentId}', [StudentRegistrationController::class, 'updateStudentPromotion'])->name('student.assignation.promotion.update');
});
