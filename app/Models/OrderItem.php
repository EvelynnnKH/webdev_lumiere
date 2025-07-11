<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_item_id';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'rating',
        'status_del',
    ];

    protected $casts = [
        'status_del' => 'boolean'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
