<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // Table Name
    protected $table = 'report';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
