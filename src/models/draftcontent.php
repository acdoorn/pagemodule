<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftcontent extends Eloquent {
    protected $table = 'content_draft';

    public function draftmodule() {
        return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'draftmodule_id');
    }

    public function draftpage() {
        return $this->belongsTo('Acdoorn\Pagemodule\Draftpage', 'draftpage_id');
    }

    public function draftsection() {
        return $this->belongsTo('Acdoorn\Pagemodule\Draftsection', 'draftsection_id');
    }

    public function news() {
        return $this->belongsTo('Acdoorn\Pagemodule\News', 'contentid');
    }

    public function article() {
        return $this->belongsTo('Acdoorn\Pagemodule\Article', 'contentid');
    }

    public function articlelist() {
        return $this->belongsTo('Acdoorn\Pagemodule\Articlelist', 'contentid');
    }

    public function layout() {
        return $this->belongsTo('Acdoorn\Pagemodule\Draftcontenttemplate', 'draftcontenttemplate_id');
    }
}