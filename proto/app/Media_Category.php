<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media_Category extends Model
{
    // Table Name
    protected $table = 'media_category';
    // Primary Key
    public $primaryKey = 'cat_id';
    // Timestamps
    public $timestamps = false;
}
