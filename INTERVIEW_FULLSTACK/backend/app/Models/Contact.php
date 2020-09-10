<?php

namespace App\Models;

use App\Models\Email;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'job_title',
        'company_name',
        'age',
        'created_at',
        'edited_at'
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
