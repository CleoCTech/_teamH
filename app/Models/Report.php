<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

   /**
    * Get the user that owns the Report
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class, 'sender_id', 'id');
   }

   /**
    * Get all of the comments for the Report
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function comments(): HasMany
   {
       return $this->hasMany(Comment::class, 'report_id', 'id');
   }
}