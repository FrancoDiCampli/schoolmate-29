<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $fillable = ['title', 'description', 'subject_id', 'content', 'user_id'];

    // protected $guarded = [];

    public function annotations()
    {
        return $this->hasMany('App\Annotation');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
