<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_table extends Model
{
    // Table Name
    protected $table = 'users';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
