<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Drafttemplate extends Eloquent {
    protected $table = 'template_draft';

    public function draftsections() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'template_has_section_draft');
    }
    
    public function draftpage() {
    	return $this->hasOne('Acdoorn\Pagemodule\Draftpage');
    }    
}