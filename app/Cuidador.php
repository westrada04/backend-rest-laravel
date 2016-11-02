<?php
/**
 * Created by PhpStorm.
 * User: westrada
 * Date: 29/10/16
 * Time: 7:36 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuidador extends Model
{

    protected $table = 'cuidadores';

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function ninos(){
        return $this->belongsToMany('App\Nino');
    }
}