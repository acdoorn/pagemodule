<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class News extends Eloquent {
    protected $table = 'news';

    public function madeby() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'madebymodule_id');
    }

    public function draftpages() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftpage', 'news_draftpage')->withPivot('draftpage_id');
    }

    public function draftsections() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'news_draftpage')->withPivot('draftsection_id');
    }
}