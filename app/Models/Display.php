<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Model: Display
 *
 * Represents an advertising display owned by a user.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price_per_day
 * @property int $resolution_height
 * @property int $resolution_width
 * @property string $type
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Display extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_day',
        'resolution_height',
        'resolution_width',
        'type',
        'user_id',
    ];

    /**
     * Relation: display belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
