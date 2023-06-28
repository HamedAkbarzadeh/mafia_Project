<?php

namespace App\Models\Ticket;

use App\Models\User;
use App\Models\Ticket\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['subject', 'description', 'parent_id','status', 'seen', 'reference_id', 'user_id', 'category_id', 'priority_id', 'ticket_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }
    public function priority()
    {
        return $this->belongsTo(TicketPriority::class);
    } 
    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class , 'reference_id');
    } 
    public function parent(){
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }
    public function children(){
        return $this->hasMany($this, 'parent_id')->with('children');
    }
}
