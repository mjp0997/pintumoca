<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_line';

    protected $fillable = ['sale_id', 'product_id', 'price', 'quantity'];

    protected $appends = ['subtotal'];



    // Appended attributes

    public function getSubtotalAttribute() {
        return number_format($this->price * $this->quantity, 2);
    }



    // Relationships

    /**
     * Get the sale that owns the SaleLine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    /**
     * Get the product that owns the SaleLine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
}
