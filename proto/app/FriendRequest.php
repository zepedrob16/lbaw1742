<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    // Table Name
    protected $table = 'friend_request';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
