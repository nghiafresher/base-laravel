<?php

namespace App\Models;

class Permission extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'model_name'
    ];

    public $timestamps = false;
}
