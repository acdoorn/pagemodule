<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftinput extends Eloquent {
    protected $table = 'input_draft';

    public function draftfield()) {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftfield');
    }
}