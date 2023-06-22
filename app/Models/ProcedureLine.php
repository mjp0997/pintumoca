<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcedureLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'procedure_line';

    protected $fillable = ['procedure_id', 'product_id', 'quantity'];



    // Relationships

    /**
     * Get the procedure that owns the ProcedureLine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    /**
     * Get the product that owns the ProcedureLine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
}
