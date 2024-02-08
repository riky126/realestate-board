<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proprietor extends Model
{
    use HasFactory;

    protected $table = 'proprietors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'lot_number',
        'unit_entitlement',
        'postal_address',
        'maintenance_fee'
    ];

    /**
     * Get the phone associated with the user.
    */
  
    public function corporation(): BelongsTo {
        return $this->belongsTo(Corporation::class);
    }

    /**
     * Get the proprietors of the Corporation.
     */
    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }
}
