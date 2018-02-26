<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    // Could set specific table name
    // protected $table = 'posts';

    // Primary Key
    // Could set specific primary key
    // public $primaryKey = 'id';

    // Timestamps
    // public $timestamps = true;

    // Create a relationship with User
    public function user(){
        return $this->belongsTo('App\User');
    }
}
