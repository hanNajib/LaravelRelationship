<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];    

    /**
     * Get the user that owns the Profile
     * Pake belongTo kalo foreign key berada di model saat ini
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // user id dari foreign key profile dan id berasal dari id user
    }
}
