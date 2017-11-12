<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ['firstname_id', 'lastname_id','personal_code','email','adress','city_id','country_id'];
}
