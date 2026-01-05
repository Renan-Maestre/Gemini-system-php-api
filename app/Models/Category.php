<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'user_id', 'name'
    ];


    protected static function booted()
    {
        static::creating(function (Category $category) {
            // Lógica para gerar o ID sequencial por usuário
            $category->id = static::where('user_id', $category->user_id)->max('id') + 1;
        });
    }

}
