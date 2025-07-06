<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products'; // Should match your phpMyAdmin table name
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'category'
    ];

    // Reusable validation rules
    public static function rules($forUpdate = false)
    {
        return [
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:50'
        ];
    }
}