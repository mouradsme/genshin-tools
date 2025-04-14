<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorldQuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'guide_link',
        'region_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function userQuests()
    {
        return $this->hasMany(UserQuest::class);
    }
}
