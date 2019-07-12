<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function wallet(){
    	return $this->belongsTo('App\Wallet');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
