<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companystructure extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'comp_code', 
            'description', 
            'address',
            'type',
            'country',
            'parent',
            'timezone',
            'heads',
            'posting_date',
            'approval_status'
    ];
}



