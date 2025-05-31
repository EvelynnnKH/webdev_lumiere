<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'wishlist_id';
    protected $fillable = ['user_id', 'status_del'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(WishlistItem::class, 'wishlist_id', 'wishlist_id')->active();
    }
    
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class, 'wishlist_id', 'wishlist_id')->active();
    }

    public function scopeActive($query)
    {
        return $query->where('status_del', false);
    }

}
