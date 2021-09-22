<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MergeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all of the merges for the MergeCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function merges(): HasMany
    {
        return $this->hasMany(MergeReport::class, 'category_id', 'id');
    }
}