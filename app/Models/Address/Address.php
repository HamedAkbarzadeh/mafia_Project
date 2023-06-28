<?php

namespace App\Models\Address;

use App\Models\User;
use App\Models\Address\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory; 
    protected $table = 'addresses';

    protected $fillable = ['user_id' , 'city_id' , 'postal_code' , 'address' , 'no' , 'unit' , 'recipient_first_name' , 'recipient_last_name' , 'mobile' , 'receiver' , 'status']; 

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->recipient_first_name. ' ' .$this->recipient_last_name;
    }
}
