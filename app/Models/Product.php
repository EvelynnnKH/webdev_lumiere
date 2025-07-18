<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $table = 'products';
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image_url',
        // 'status_del', // Jika pakai soft delete manual
    ];
}
