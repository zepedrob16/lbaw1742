<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Post extends Model
{
    // Table Name
    protected $table = 'image_post';
    // Primary Key
    public $primaryKey = 'id_post';
    // Timestamps
    public $timestamps = false;
}
