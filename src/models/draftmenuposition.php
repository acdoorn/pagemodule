<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftmenuposition extends Eloquent {
    protected $table = 'menuposition_draft';

    public function draftmenu() {
    	return $this->hasOne('Acdoorn\Pagemodule\Draftmenu');
    }
}