<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public function teamAnswers()
    {
        return $this->hasMany(TeamAnswer::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
}