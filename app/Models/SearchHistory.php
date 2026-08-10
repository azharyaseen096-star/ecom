<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;
    protected $fillable = [

    'keyword',

    'type',

    'url',

    'title',

    'success',

    'error',

    'duration',

    'ip_address',

    'user_agent'

];
}
