<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'type',
        'photo'
    ];

    public static $types = [
        'coffee', 'tea', 'other','sweets'
    ];

    public function getHargaAttribute()
    {
        // return number_format($this->attributes['price'], 0, ',', '.');
        return "Rp" . Number::format($this->price);
    }

    public function getGambarAttribute()
    {
        return $this->photo ? Storage::url($this->photo) : url('/images/noimage.png');
    }


}
