<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'type', 'first_name', 'last_name', 'email', 'phone_number',
        'street_address', 'city', 'state', 'postal_code', 'country'
    ];

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCountryNameAttribute(): string
    {
        return Countries::getName($this->country);
    }
}
