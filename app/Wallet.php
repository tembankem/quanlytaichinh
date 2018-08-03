<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function walletTransaction(){
    	return $this->hasMany('App\WalletTransaction');
    }

    public function walletTransactionReceive(){
    	return $this->hasMany('App\WalletTransaction','receive_wallet_id');
    }
}
