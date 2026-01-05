<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'category_id', 'user_id', 'name', 'description', 'price', 'quantity','status','image'
    ];

    protected static function booted(){
        static::creating(function ($product) {
            $product->id = static::where('user_id', $product->user_id)->max('id') + 1;
        });
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'uuid');
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

}
