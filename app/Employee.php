<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
