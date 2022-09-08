<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [    ];






    public function profileImage()
    {
        $txt = ($this->image) ? $this->image : 'profile/DarX2iyaRPvcR6KdIGUO2Ajrc5F0VgRNOeQsGg0R.png';

        return '/storage/'. $txt ;
    }

    public function followers()
    {
    return $this->belongsToMany(User::class);
    }
    // use HasFactory;
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
