<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_payment';

    protected $fillable = ['sale_id', 'currency_id', 'payment_id', 'amount', 'dollar_rate'];

    protected $appends = ['dollars_amount', 'formated_amount'];



    // Appended attributes

    public function getDollarsAmountAttribute()
    {
        if ($this->currency->name == 'bolívares') {
            return number_format($this->amount / $this->dollar_rate, 2);
        }

        return number_format($this->amount, 2);
    }

    public function getFormatedAmountAttribute()
    {
        $currency = number_format($this->amount, 2);

        $unit = $this->currency->iso_code;

        return "$currency $unit";
    }



    // Relationships

    /**
     * Get the sale that owns the SalePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    /**
     * Get the payment method that owns the SalePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }

    /**
     * Get the currency that owns the SalePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
