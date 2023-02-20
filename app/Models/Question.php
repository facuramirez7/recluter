<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interview;
use App\Models\QuestionAnswered;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question','interview_id','video'];

    //relationship with Interview model
    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    //relationship with QuestionAnswered model
    public function questionAnswered()
    {
        return $this->hasMany(QuestionAnswered::class);
    }
    
}
