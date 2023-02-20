<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Question;


class Interview extends Model
{
    use HasFactory;

    protected $fillable = ['position','user_id','company_id'];

    //relationship with Company model
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //relationship with Question model
    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
