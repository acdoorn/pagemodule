<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftmenu extends Eloquent {
    protected $table = 'menu_draft';

    public function draftmenuitems() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftmenuitem', 'menu_has_menuitem_draft')->withPivot('order', 'parent');
    }

    public function draftmenuposition() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftmenuposition', 'draftmenuposition_id');
    }
}