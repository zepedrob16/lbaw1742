<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation_Message extends Model
{
    // Table Name
    protected $table = 'conversation_message';
    // Primary Key
    public $primaryKey = 'id_recipient';
    // Timestamps
    public $timestamps = false;
}
