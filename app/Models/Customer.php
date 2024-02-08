<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function corporation() {
        return $this->hasOne(Corporation::class, 'account_holder_id');
    }
}
