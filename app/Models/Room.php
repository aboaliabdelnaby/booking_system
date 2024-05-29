<?php

namespace App\Models;

use App\Enum\RoomStatus;
use App\Enum\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'type', 'status',
    ];
    protected $casts = [
        'status' => RoomStatus::class,
        'type' => RoomType::class,
    ];

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
