<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $table = 'leavetypes';

    protected $fillable = [
            'name',
            'leave_gl', 
            'supervisor_leave_assign', 
            'employee_can_apply',
            'apply_beyond_current',
            'leave_accrue',
            'carried_forward',
            'default_per_year',
            'carried_forward_percentage',
            'carried_forward_leave_availability',
            'propotionate_on_joined_date',
            'send_notification_emails',
            'leave_group',
            'leave_color',
            'max_carried_forward_amount',
            'employee_leave_period'
    ];
}
