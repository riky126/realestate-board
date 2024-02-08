<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'is_active'
    ];

    public function owner() {
        return $this->belongsTo(Customer::class, 'owner_id');
    }

    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }
}
