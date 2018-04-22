<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text_Post extends Model
{
    // Table Name
    protected $table = 'text_post';
    // Primary Key
    public $primaryKey = 'id_post';
    // Timestamps
    public $timestamps = false;
}
