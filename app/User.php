<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password', 'birthday', 'phone', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wallet(){
        return $this->hasMany('App\Wallet');
    }

    public function category(){
        return $this->hasMany('App\Category');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

    public function walletTransaction(){
        return $this->hasMany('App\WalletTransaction');
    }
}
