<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=['firstname','lastname' , 'company_id' , 'email' , 'phone'];
    protected $table = 'employees';
    public $timestamps = true;


    public function company(){
        return $this->belongsTo(Company::class);
    }
}
