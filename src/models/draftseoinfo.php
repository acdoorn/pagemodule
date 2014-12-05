<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftseoinfo extends Eloquent {
    protected $table = 'seoinfo_draft';
    
    public function drafturl() {
    	return $this->hasOne('Acdoorn\Pagemodule\Drafturl');
    }
}