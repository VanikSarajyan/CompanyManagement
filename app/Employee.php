<?php

namespace App;

use App\Mail\NewEmployeeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($employee) {
            Mail::to($employee->company->email)->send(new NewEmployeeMail($employee));
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
