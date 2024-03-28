<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['file_path'];

    /**
     * Define la relación entre el documento y la tarea.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
