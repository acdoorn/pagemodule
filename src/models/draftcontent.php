<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftcontent extends Eloquent {
    protected $table = 'content_draft';

    public function drafturl() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Drafturl', 'id');
    }

    public function drafttemplate() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Drafttemplate', 'template_id');
    }

    public function articles() {
    	return $this->hasMany('Acdoorn\Pagemodule\Article')->withPivot('article_id');
    }

    public function articlesections() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'article_draftpage')->withPivot('draftsection_id');
    }

    public function newssections() {
        return $this->belongsToMany('Acdoorn\Pagemodule\Draftsection', 'news_draftpage')->withPivot('draftsection_id');
    }

    public function news() {
        return $this->hasMany('Acdoorn\Pagemodule\News')->withPivot('news_id');
    }
}