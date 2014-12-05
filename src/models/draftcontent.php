<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftcontent extends Eloquent {
    protected $table = 'contenttemplate_draft';

    public function draftsection() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftsection');
    }

    public function draftfields() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftfield');
    }
}
