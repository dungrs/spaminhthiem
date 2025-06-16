<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MenuCatalogue extends Model
{
    use HasFactory, QueryScopes, Notifiable;

    protected $table = 'menu_catalogues';

    protected $fillable = [
        'name',
        'keyword',
        'publish',
    ];
}
