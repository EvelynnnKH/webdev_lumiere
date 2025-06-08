<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishlistItem extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'wishlist_id',
        'product_id',
        'quantity',
        'status_del',
    ];

    protected $casts = [
        'status_del' => 'boolean',
    ];

    protected $primaryKey = 'wishlist_item_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'wishlist_id', 'wishlist_id');
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
