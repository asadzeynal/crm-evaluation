<?php

namespace App;

use App\Mail\CompanyCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Company extends Model
{
    public function employees() {
        return $this->hasMany('App\Employee');
    }

    protected static function booted()
    {
        static::created(function ($company) {
            Mail::to(getenv('MAIL_REPORT_TO_ADDRESS'))->send(new CompanyCreated($company));
        });
    }
}
