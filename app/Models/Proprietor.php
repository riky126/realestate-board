<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    ];

    /**
     * Get the phone associated with the user.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function account() {
        return $this->hasOne(Account::class);
    }
}
