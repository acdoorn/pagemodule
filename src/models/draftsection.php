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

    public function content() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftcontent', 'contentid');
    }

    public function draftpages() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftpage', 'content_draft');
    }
}