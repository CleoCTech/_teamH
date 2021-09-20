<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * Get all of the user_designations for the Designation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_designations(): HasMany
    {
        return $this->hasMany(UserDesignation::class, 'designation_id', 'id');
    }

}