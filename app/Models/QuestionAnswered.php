<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class QuestionAnswered extends Model
{
    use HasFactory;

    //relationship with Question model
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
