<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    // Table Name
    protected $table = 'friendship';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
