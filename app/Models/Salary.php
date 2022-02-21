<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const MONTH_SELECT = [
        'january'   => 'january',
        'february'  => 'february',
        'march'     => 'march',
        'april'     => 'april',
        'may'       => 'may',
        'june'      => 'june',
        'july'      => 'july',
        'august'    => 'august',
        'september' => 'september',
        'october'   => 'october',
        'november'  => 'november',
        'december'  => 'december',
    ];

    public $table = 'salaries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'employee_id',
        'month',
        'taken_salary',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
