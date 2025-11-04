<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staffs(){
        return $this->hasMany(Staff::class);
    }
}
