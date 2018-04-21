<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'post';
    // Primary Key
    public $primaryKey = 'postnumber';
    // Timestamps
    public $timestamps = true;
}
