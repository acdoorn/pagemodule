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

    public function content() {
    	return $this->hasMany('Acdoorn\Pagemodule\Draftcontent');
    }

    public function news() {
        return $this->belongsTo('Acdoorn\Pagemodule\News', 'content_draft', 'content_id');
    }

    public function sections() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'content_draft', 'draftpage_id', 'draftsection_id');
    }
}