<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'from_office_id', 'to_office_id', 'date'];



    // Relationships

    /**
     * Get all of the procedureLines for the Procedure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureLines(): HasMany
    {
        return $this->hasMany(ProcedureLine::class, 'procedure_id');
    }

    /**
     * Get the fromOffice that owns the Procedure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'from_office_id');
    }

    /**
     * Get the toOffice that owns the Procedure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'to_office_id');
    }

    /**
     * Get the user that owns the Procedure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
