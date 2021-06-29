<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'loja.plans';


    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'active' => 'boolean',
        'name' => 'string',
        'identifier' => 'string',
        'amount_value' => 'integer',
        'discount_value' => 'integer'
    ];

    protected $fillable  = [
        'id',
        'active',
        'name',
        'identifier',
        'amount_value',
        'discount_value'
    ];


}
