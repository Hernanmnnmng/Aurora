<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'event_name',
        'event_date',
        'customer_name',
        'customer_email',
        'seat',
        'used',
        'used_at',
        'expires_at',
        'cancelled',
        'cancelled_at',
        'notes',
        'user_id'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'used' => 'boolean',
        'cancelled' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            // Generate a unique code if one is not provided
            if (!$ticket->code) {
                $ticket->code = self::generateUniqueCode();
            }
        });
    }

    public static function generateUniqueCode($length = 10)
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    public function isValid()
    {
        return !$this->used && !$this->cancelled && (!$this->expires_at || $this->expires_at > now());
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at < now();
    }

    public function markAsUsed()
    {
        $this->used = true;
        $this->used_at = now();
        $this->save();
    }    public function markAsCancelled()
    {
        $this->cancelled = true;
        $this->cancelled_at = now();
        $this->save();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBarcodeAttribute()
    {
        return $this->code;
    }
}