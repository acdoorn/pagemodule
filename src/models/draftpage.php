<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftpage extends Eloquent {
    protected $table = 'page_draft';

    public function drafturl() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Drafturl', 'id');
    }

    public function drafttemplate() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Drafttemplate', 'template_id');
    }
}