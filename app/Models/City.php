<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class City extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function users()
    {
        return $this->hasMany(User::class, 'city_code');
    }
    public function tokos()
    {
        return $this->hasMany(Toko::class, 'city_code');
    }
}
