<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Table Name
    protected $table = 'member';
    // Primary Key
    public $primaryKey = 'id_user';
    // Timestamps
    public $timestamps = false;
}
