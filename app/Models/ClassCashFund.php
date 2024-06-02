<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCashFund extends Model
{
    use HasFactory;

    protected $table = 'class_cash_fund';

    protected $fillable = [
       'student_id',
       'status',
        'date',
        'amount',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
