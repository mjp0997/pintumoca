<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'office_id', 'client_id', 'date'];

    protected $appends = ['total', 'products_quantity', 'debt'];



    // Appended attributes

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->lines as $line) {
            $total += $line->price * $line->quantity;
        }

        return number_format($total, '2');
    }

    public function getProductsQuantityAttribute()
    {
        $quantity = 0;

        foreach ($this->lines as $line) {
            $quantity += $line->quantity;
        }

        return $quantity;
    }

    public function getDebtAttribute()
    {
        $debt = $this->total;

        foreach ($this->payments as $payment) {
            $debt -= $payment->dollars_amount;
        }

        return number_format($debt, '2');
    }



    // Relationships

    /**
     * Get the user that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * Get the office that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id')->withTrashed();
    }

    /**
     * Get the client that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }

    /**
     * Get all of the lines for the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lines(): HasMany
    {
        return $this->hasMany(SaleLine::class, 'sale_id');
    }

    /**
     * Get all of the payments for the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(SalePayment::class, 'sale_id');
    }
}
