<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory, Notifiable, QueryScopes;
    
    protected $fillable = [
        'name',
        'keyword',
        'description',
        'album',
        'model_id',
        'modelParent',
        'model',
        'short_code',
        'publish',
    ];

    protected $table = 'widgets';

    protected $casts = [
        'model_id' => 'json',
        'album' => 'json',
    ];

    public function languages() {
        return $this->belongsToMany(Language::class, 'widget_languages', 'widget_id', 'language_id')
                    ->withPivot('name', 'keyword', 'description')
                    ->withTimestamps();
    }
}
