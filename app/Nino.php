<?php
/**
 * Created by PhpStorm.
 * User: westrada
 * Date: 29/10/16
 * Time: 7:36 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nino extends Model
{
    protected $table = 'ninos';

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function cuidadores(){
        return $this->belongsToMany('App\Cuidador');
    }
}
