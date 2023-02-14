<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interview;

class Company extends Model
{
    use HasFactory;

    //relationship with Interview model
    public function interview()
    {
        return $this->hasMany(Interview::class);
    }
}
