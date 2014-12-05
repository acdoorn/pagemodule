<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftsection extends Eloquent {
    protected $table = 'section_draft';

    public function drafttemplates() {
    	return $this->hasMany('Acdoorn\Pagemodule\Drafttemplate');
    }

    public function draftcontent() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftcontent');
    }
}