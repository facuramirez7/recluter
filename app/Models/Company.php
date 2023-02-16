<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interview;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','photo','description'];

    //relationship with Interview model
    public function interview()
    {
        return $this->hasMany(Interview::class);
    }
}
