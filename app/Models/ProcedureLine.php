<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcedureLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'procedure_line';

    protected $fillable = ['procedure_id', 'product_id', 'quantity'];
}
