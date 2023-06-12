<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public const PENDING_STATUS = 'Очікує підтвердження';

    /**
     * @var string
     */
    public const SUCCESS_STATUS = 'Очікує підтвердження';

    /**
     * @var string[]
     */
    protected $fillable = [
        'status_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
