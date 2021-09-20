<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportGroup extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'toable_id', 'toable_type' ];


    public function toable()
    {
        return $this->morphTo();
    }

    /**
     * Get the report that owns the ReportGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'report_id', 'id');
    }
}
