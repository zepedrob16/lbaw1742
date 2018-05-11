<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Open_Message extends Model
{
    // Table Name
    protected $table = 'conversation_message';
    // Primary Key
    public $primaryKey = 'id_conversation';
    // Timestamps
    public $timestamps = false;
}