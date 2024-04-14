<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'images',
        'funded_data',
        'purchase_price',
        'funder_count',
        'rental_income',
        'current_rent',
        'percent',
        'location_string',
        'location_point',
        'property_price_total',
        'property_price',
        'transaction_costs',
        'service_charge',
        'approved',
        'category_id'
    ];
    protected $casts = [
        'images' =>  'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }
    public function location()
    {
        return $this->hasOne(location::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
    public function funders()
    {
        return $this->hasMany(Funder::class);
    }
}
