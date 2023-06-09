<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentLinksPrice extends Model
{
    use HasFactory;

    public function payment_link_names():BelongsTo
    {
        return $this->belongsTo(PaymentLinksName::class,'product_id');
    }
}
