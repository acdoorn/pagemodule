<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Drafttemplate extends Eloquent {
    protected $table = 'template_draft';

    public function draftsections() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftsection');
    }
    public function draftpage() {
    	return $this->hasOne('Acdoorn\Pagemodule\Draftpage');
    }
}