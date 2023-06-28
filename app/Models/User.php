<?php

namespace App\Models;

use App\Models\User\Role;
use App\Models\Ticket\Ticket;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Address\Address;
use App\Models\Content\Comment;
use App\Models\Event\Event;
use App\Models\Event\Mafia;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ticket\TicketAdmin;
use App\Models\Permission\Permission;
use App\Traits\Permissions\HasPermissionsTrait;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use SoftDeletes;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasPermissionsTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'mobile',
        'last_name',
        'name',
        'email',
        'profile_photo_path', 
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'national_code',
        'slug',
        'email_verified_at',
        'mobile_verified_at',
        'activation',
        'activation_date',
        'user_type',
        'status',
        'current_team_id', 
    ];
    
    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'title'
            ]
            ];
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_photo_path' => 'array'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }


    public function ticketAdmin(){
        return $this->hasOne(TicketAdmin::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    } 
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot('payment_status' , 'mafia_id' , 'win_status' , 'side' ,'random_code');
    }
    public function mafiaRole()
    {
        return $this->hasOne(Mafia::class , 'mafia_id');
    }
}
