<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toable(){
        return $this->morphMany(ReportGroup::class, 'toable');
    }
    
    /**
     * Get the dept_membership associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dept_membership(): HasOne
    {
        return $this->hasOne(DeptMember::class, 'user_id', 'id');
    }
    /**
     * Get the designation associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function designation(): HasOne
    {
        return $this->hasOne(UserDesignation::class, 'user_id', 'id');
    }

    

}