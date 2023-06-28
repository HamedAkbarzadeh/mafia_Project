<?php

namespace App\Models\Event;

use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mafia extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }
}
