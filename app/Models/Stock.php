<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'office_id', 'stock'];



    // Relationships

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
