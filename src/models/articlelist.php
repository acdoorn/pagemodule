<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Articlelist extends Eloquent {
    protected $table = 'articlelist';

    public function madeby() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'madebymodule_id');
    }

    public function draftpages() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftpage', 'content_draft');
    }

    public function draftsections() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'content_draft');
    }

    public function draftcontent() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftcontent', 'content_draft', 'contentid');
    }
}