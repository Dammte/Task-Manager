<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment'];

    /**
     * Define la relación entre el comentario y la tarea.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
