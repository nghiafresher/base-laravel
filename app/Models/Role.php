<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Role extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public $timestamps = false;
}
