<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

class AssignSubject extends Model
{
    use HasFactory;

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function studentSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
