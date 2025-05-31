<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
        'total_price',
        'shipping_address',
        'status_del'
    ];

    protected $casts = [
        'order_date' => 'date',
        'status_del' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


   public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }


    public function payment()
    {
        return $this->hasOne(Orders::class, 'order_id');
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
