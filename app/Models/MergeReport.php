<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MergeReport extends Model
{
    use HasFactory;
    protected $fillable = ['report_id', 'category_id'];


    /**
     * Get the report that owns the MergeReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'report_id', 'id');
    }
    /**
     * Get the category that owns the MergeReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MergeCategory::class, 'category_id', 'id');
    }
}