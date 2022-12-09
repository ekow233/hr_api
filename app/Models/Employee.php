<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
            'employee_id',
            'title',
            'first_name',
            'middle_name',
            'last_name',
            'birthday',
            'bank_acc_no',
            'pay_grade',
            'notches',
            'home_phone',
            'mobile_phone',
            'work_phone',
            'work_email',
            'private_email',
            'recruitment_date',
            'supervisor',
            'indirect_supervisors',
            'branch',
            'updated_date'
    ];

    protected $casts = [

        // 'indirect_supervisors' => 'array'
    ];
}
