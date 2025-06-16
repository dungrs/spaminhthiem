<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Language;
use App\Traits\QueryScopes;

class Post extends Model
{
    use HasApiTokens, HasFactory, Notifiable, QueryScopes;

    protected $fillable = [
        'image',
        'album',
        'publish',
        'order',
        'user_id',
        'follow',
        'post_catalogue_id'
    ];

    protected $table = 'posts';

    public function languages() {
        return $this->belongsToMany(Language::class, 'post_languages', 'post_id', 'language_id')
                    ->withPivot('name', 'content', 'canonical', 'meta_title', 'meta_keyword', 'meta_description', 'description')
                    ->withTimestamps();
    }

    public function post_catalogues() {
        return $this->belongsToMany(PostCatalogue::class, 'post_catalogue_post', 'post_id', 'post_catalogue_id');
    }
}
