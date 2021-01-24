<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custormer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'surname',
        'add1',
        'add2',
        'postcode',
        'email',
        'phone'
    ];
    public $timestamps = false;

}
