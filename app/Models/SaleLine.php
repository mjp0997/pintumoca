<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_line';

    protected $fillable = ['sale_id', 'stock_id', 'price', 'quantity'];
}
