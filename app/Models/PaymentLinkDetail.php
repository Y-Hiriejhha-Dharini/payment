<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentLinkDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment_link():BelongsTo
    {
        return $this->belongsTo(PaymentLink::class,'payment_link_id');
    }

    public function payment_link_name():BelongsTo
    {
        return $this->belongsTo(PaymentLinkName::class);
    }
}
