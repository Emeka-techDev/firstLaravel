<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    // we named this virtualUser so it can be clear to us where we got it from
    // that we created it ourselves and it is not gotten from laravel models magic variable
    public function virtualUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
