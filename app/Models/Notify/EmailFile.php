<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model; 

class EmailFile extends Model
{
    protected $table = 'public_mail_files'; 
    use HasFactory , SoftDeletes ; 
    
    protected $fillable = ['public_mail_id' , 'file_path', 'file_size' , 'file_type' , 'status' , 'private']; 


    public function email(){
        return $this->belongsTo(Email::class ,'public_mail_id');
    }
}
