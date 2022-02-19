<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    public $timestamps = false;

    protected $fillable = ['userId', 'comment'];
}
