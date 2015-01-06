<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent {
    protected $table = 'article';

    public function madeby() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'madebymodule_id');
    }

    public function draftpages() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftpage', 'article_draftpage')->withPivot('draftpage_id');
    }

    public function draftsections() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'article_draftpage')->withPivot('draftsection_id');
    }
}