<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'subject' , 'description' , 'keywords' , 'icon' , 'bannerImage' , 'ruleImage' , 'whiteLogo' , 'blackLogo' ];
}
