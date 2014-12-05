<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftfield extends Eloquent {
    protected $table = 'field_draft';


    public function draftinput()) {
    	return $this->hasOne('Acdoorn\Pagemodule\Draftinput');
    }
}