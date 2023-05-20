<?php

namespace App\Models\Department;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'department',
        'created_at',
        'updated_at',
    ];


    public function Doctor(): HasMany
    {
        return $this->hasMany(Doctor::class, 'department_id');

    }

}
