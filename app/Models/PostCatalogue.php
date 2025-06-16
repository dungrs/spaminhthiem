<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PostCatalogue extends Model
{
    use HasFactory, QueryScopes, Notifiable;

    protected $table = 'post_catalogues';

    protected $fillable = [
        'parent_id',
        'lft',
        'rgt',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'order',
        'user_id',
        'follow',
    ];

    protected $casts = [
        'album' => 'json'
    ];

    public function languages() {
        return $this->belongsToMany(Language::class, 'post_catalogue_languages', 'post_catalogue_id', 'language_id')
                    ->withPivot('name', 'canonical', 'meta_title', 'meta_keyword', 'meta_description', 'description')
                    ->withTimestamps();
    }

    public function posts() {
        return $this->belongsToMany(Post::class, 'post_catalogue_post', 'post_catalogue_id', 'post_id')
                    ->with('languages');
    }

    public static function isNodeCheck($id = 0) {
        $postCatalogue = PostCatalogue::find($id);
        if ($postCatalogue->rgt - $postCatalogue->lft !== 1) {
            return false;
        }

        return true;
    }
}
