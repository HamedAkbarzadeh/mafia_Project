<?php

namespace App\Models\Event;

use App\Models\User;
use App\Models\Event\Mafia;
use App\Models\Market\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory ,SoftDeletes;

    protected $guarded = ['id'];

    public function mafias()
    {
        return $this->belongsToMany(Mafia::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('payment_status' , 'mafia_id' , 'win_status' , 'side' ,  'random_code');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
