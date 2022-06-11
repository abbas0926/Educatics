<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionStudent extends Model
{
    use HasFactory;
    protected $table='promotion_student';
    protected $fillable = [
        'student_id',
        'promotion_id',
    ];
    public function promotion (){
        return $this->belongsTo(Promotion::class);
    }
    public function student (){
        return $this->belongsTo(Student::class);
    }
}
