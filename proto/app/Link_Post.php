<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link_Post extends Model
{
    // Table Name
    protected $table = 'link_post';
    // Primary Key
    public $primaryKey = 'id_post';
    // Timestamps
    public $timestamps = false;
}
