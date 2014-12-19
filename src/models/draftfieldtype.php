<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftfieldtype extends Eloquent {
    protected $table = 'fieldtype_draft';


    public function draftfield() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftfield');
    }
}