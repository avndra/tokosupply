<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'toko_id',
        'price',
        'status',
        'supplier_id',
        'stock',
    ];
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function orderedItems()
    {
        return $this->hasMany(OrderedItem::class);
    }
}
