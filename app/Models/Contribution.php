<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contribution extends Model
{
    use HasFactory;

    protected $table = 'contributions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'created_at'
    ];

    /**
     * Get the phone associated with the proprietor.
     */
    public function proprietor() {
        return $this->belongsTo(Proprietor::class);
    }

    /**
     * Get the phone associated with the proprietor.
     */
    public function corporation() {
        return $this->belongsTo(Corporation::class);
    }
}
