<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftcontenttemplate extends Eloquent {
    protected $table = 'contenttemplate_draft';

    public function draftcontent() {
        return $this->hasOne('Acdoorn\Pagemodule\Draftcontent');
    }

    public function draftmodule() {
        return $this->belongsTo('Acdoorn\Pagemodule\Draftmodule', 'Draftmodule_id');
    }
}