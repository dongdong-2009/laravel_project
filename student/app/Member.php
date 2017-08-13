<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function getMemeber(){
    	return [
    		"msg" => "This is model test",
  		];
    }
}
