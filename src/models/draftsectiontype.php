<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftsectiontype extends Eloquent {
    protected $table = 'sectiontype_draft';

    public function draftmodule() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'module_draft_id');
    }

    public function draftsection() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftsection', 'section_id');
    }

}