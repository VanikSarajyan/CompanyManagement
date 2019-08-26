<?php

namespace App;

use App\Mail\NewCompanyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($company) {
            Mail::to("administration@company.management")->send(new NewCompanyMail($company));
        });
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
