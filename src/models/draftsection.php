<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftsection extends Eloquent {
    protected $table = 'section_draft';

    public function drafttemplates() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Drafttemplate', 'template_has_section_draft');
    }

    public function draftsectiontype() {
    	return $this->hasOne('Acdoorn\Pagemodule\Draftsectiontype');
    }
}