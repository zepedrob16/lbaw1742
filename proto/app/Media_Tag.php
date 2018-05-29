<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media_Tag extends Model
{
    // Table Name
    protected $table = 'media_tag';
    // Primary Key
    public $primaryKey = 'tag_id';
    // Timestamps
    public $timestamps = false;
}
