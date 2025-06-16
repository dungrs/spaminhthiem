<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\QueryScopes;

class ProductVariant extends Model
{
    use HasApiTokens, HasFactory, Notifiable, QueryScopes;

    protected $fillable = [
        'uuid',
        'product_id',
        'code',
        'quantity',
        'sku',
        'price',
        'barcode',
        'file_name',
        'file_url',
        'publish',
        'user_id',
        'album'
    ];

    protected $table = 'product_variants';

    public function products() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'product_variant_languages', 'product_variant_id','language_id')
                    ->withPivot('name')
                    ->withTimestamps();
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'product_variant_attributes', 'product_variant_id', 'attribute_id')
                    ->withTimestamps();
    }
}