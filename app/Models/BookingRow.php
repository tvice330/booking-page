<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingRow extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'arrival_date',
        'departure_date',
        'phone_number',
        'email',
        'status_id',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function status(): HasOne
    {
        return $this->hasOne(BookingStatus::class,'id', 'status_id');
    }
}
