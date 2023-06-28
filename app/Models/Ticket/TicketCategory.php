<?php

namespace App\Models\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'status']; 

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
    
}
