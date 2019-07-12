<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $table = "wallettransactions";

    public function wallet(){
    	return $this->belongsTo('App\Wallet');
    }

    public function receiveWallet(){
    	return $this->belongsTo('App\Wallet','receive_wallet_id');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
