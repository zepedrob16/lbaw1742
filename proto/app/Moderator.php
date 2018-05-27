<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    // Table Name
    protected $table = 'moderator';
    // Primary Key
    public $primaryKey = 'id_user';
    // Timestamps
    public $timestamps = false;
}
