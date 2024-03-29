<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftmodule extends Eloquent {
    protected $table = 'module_draft';

    public function draftfields() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftfield', 'module_draft_id');
    }

    public function draftsectiontype() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftsectiontype');
    }

    public function articles() {
    	return $this->hasMany('Acdoorn\Pagemodule\Article');
    }

    public function draftcontenttemplates() {
        return $this->hasMany('Acdoorn\Pagemodule\Draftcontenttemplate');
    }
}
