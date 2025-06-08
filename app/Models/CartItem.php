<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'status_del',
    ];

    protected $casts = [
        'status_del' => 'boolean',
    ];

    protected $primaryKey = 'cart_item_id';

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id')->withTrashed();
    }

    public function scopeActive($query)
    {
        return $query->where('status_del', false);
    }
}
