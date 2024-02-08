<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_active',
        'start_date',
        'renewal_date'
    ];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function account() {
        return $this->hasOne(Account::class);
    }
}
