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

    public function articles() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Article', 'article_draftpage')->withPivot('article_id');
    }

    public function draftpages() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftpage', 'article_draftpage')->withPivot('page_id');
    }

    public function news() {
        return $this->belongsToMany('Acdoorn\Pagemodule\News', 'news_draftpage')->withPivot('news_id');
    }
}