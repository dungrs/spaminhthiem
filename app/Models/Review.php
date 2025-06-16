<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\QueryScopes;

class Review extends Model
{
    use HasApiTokens, HasFactory, Notifiable, QueryScopes;

    protected $fillable = [
        'reviewable_type',
        'customer_id',
        'parent_id',
        'lft',
        'rgt',
        'level',
        'reviewable_id',
        'description',
        'score'
    ];

    protected $table = 'reviews';

    public function reviewable() {
        return $this->morphTo();
    }

    public function customers() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}