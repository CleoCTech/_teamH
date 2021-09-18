<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportGroup extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'toable_id', 'toable_type' ];

    
    public function toable()
    {
        return $this->morphTo();
    }
}