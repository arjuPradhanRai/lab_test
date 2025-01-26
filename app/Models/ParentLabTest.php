<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentLabTest extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='parent_lab_test';
    protected $fillable = [
        'name',
        'short',
        'dep_id',
    ];
    public function department()
    {
        return $this->belongsTo(LabDepartment::class,'id');
        
    }
}
