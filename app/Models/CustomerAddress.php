<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','email','mobile','address','apartment','state','city','zip' ,'country_id','user_id'];
}
