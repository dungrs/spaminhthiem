<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Language;
use App\Traits\QueryScopes;

class MenuLanguage extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    protected $fillable = [
        'menu_id',
        'language_id',
        'menu_catalogue_id'
    ];

    protected $table = 'menu_languages';

    public function languages() {
        return $this->belongsToMany(Language::class, 'menu_languages', 'menu_id', 'language_id')
                    ->withPivot('name', 'canonical')
                    ->withTimestamps();
    }

    public function menu_catalogues() {
        return $this->belongsTo(MenuCatalogue::class, 'menu_catalogue_id');
    }
}
