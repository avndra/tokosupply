<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Toko extends Model
{
    use HasFactory;
    protected $table = 'tokos'; 
    protected $fillable = [
        'owner_id',
        'name_toko',
        'city_code',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_code');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
