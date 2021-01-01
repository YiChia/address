<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lesson extends Model
{
    //
    const LESSON_DISABLE = 0;
    const LESSON_ENABLE = 1;

    use Notifiable;

    protected $table = 'lesson';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content',
    ];

}
