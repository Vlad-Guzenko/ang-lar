<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $first_name;
    public $last_name;
    public $job_title;
    public $company_name;
    public $age;
    

    public function __construct(Contact $con)
    {
        $this->first_name = $con->first_name;
        $this->last_name = $con->last_name;
        $this->job_title = $con->job_title;
        $this->company_name = $con->company_name;
        $this->age = $con->age;
    }
}
