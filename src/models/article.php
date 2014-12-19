<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent {
    protected $table = 'article';

    public function madeby() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'madebymodule_id');
    }

    public function draftpages() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftpage')->withPivot('section_draft_id');
    }
