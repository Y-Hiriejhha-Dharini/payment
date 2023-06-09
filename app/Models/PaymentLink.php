<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment_link_detail():HasMany
    {
        return $this->hasMany(PaymentLinkDetail::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
