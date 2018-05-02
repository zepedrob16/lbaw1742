<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Reaction extends Model
{
    // Table Name
    protected $table = 'post_reaction';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
