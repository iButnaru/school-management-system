<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;

    public function assignedStudent()
    {
        return  $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function discount()
    {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }

    public function assignedClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function assignedYear()
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function assignedGroup()
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    public function assignedShift()
    {
        return $this->belongsTo(StudentShift::class, 'shift_id', 'id');
    }
}
