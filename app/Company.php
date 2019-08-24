<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
