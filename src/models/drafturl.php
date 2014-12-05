<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Drafturl extends Eloquent {
    protected $table = 'url_draft';

    public function draftseoinfo() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftseoinfo', 'id');
    }
    public function draftpage() {
    	return $this->hasOne('Acdoorn\Pagemodule\Draftpage');
    }
}