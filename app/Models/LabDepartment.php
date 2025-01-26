<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabDepartment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='lab_department';
    protected $fillable = [
        'dep_name',
    ];
    
}
