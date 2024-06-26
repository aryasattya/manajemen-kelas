<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'nisn',
        'name',
        'phone',
        'address',
        'major',
      
    ];

  
   

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function ClassCashFund()
    {
        return $this->hasMany(ClassCashFUnd::class);
    }
}
