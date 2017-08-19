<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['content', 'status', 'user_id'];

    //Task のインスタンスが所属している唯一の User を取得(user:task = 1:多)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
