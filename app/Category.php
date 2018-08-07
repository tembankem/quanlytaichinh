<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function parent(){
    	return $this->belongsTo('App\Category','parent_id');
    }

    public function child(){
    	return $this->hasMany('App\Category','parent_id');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }
}
