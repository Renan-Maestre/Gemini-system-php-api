<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id','user_id', 'name', 'email','cpf_cnpj', 'phone', 'address',  'status'
    ];

    protected static function booted(){
        static::creating(function ($client) {
            $client->id = static::where('user_id', $client->user_id)->max('id') + 1;
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
