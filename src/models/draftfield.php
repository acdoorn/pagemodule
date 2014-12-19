<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftfield extends Eloquent {
    protected $table = 'field_draft';


    public function draftmodule() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'module_draft_id');
    }    
    
    public function draftfieldtype() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftfieldtype', 'fieldtype_draft_id');
    }
}