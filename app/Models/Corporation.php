<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Corporation extends Model
{
    use HasFactory;

    protected $table = 'corporations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number'
    ];

    /**
     * Get the phone associated with the user.
     */
    public function account_holder(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the proprietors of the Corporation.
     */
    public function proprietors(): HasMany
    {
        return $this->hasMany(Proprietor::class);
    }

    /**
     * Get the proprietors of the Corporation.
     */
    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

}
