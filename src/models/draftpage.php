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

    public function articles() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Article', 'article_draftpage')->withPivot('article_id');
    }

    public function articlesections() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'article_draftpage')->withPivot('draftsection_id');
    }

    public function newssections() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'news_draftpage')->withPivot('draftsection_id');
    }

    public function news() {
        return $this->belongsToMany('Acdoorn\Pagemodule\News', 'news_draftpage')->withPivot('news_id');
    }
}