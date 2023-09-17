<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionRole extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'permission_id',
        'role_id'
    ];

    public $timestamps = false;
}
