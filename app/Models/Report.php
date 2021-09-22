<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['report', 'sender_id', 'comment'];

    /**
     * Get all of the merges for the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function merges(): HasMany
    {
        return $this->hasMany(MergeReport::class, 'report_id', 'id');
    }
}