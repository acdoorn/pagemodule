<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftcontenttype extends Eloquent {
    protected $table = 'contenttype_draft';


    public function draftfield() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftfield');
    }
}