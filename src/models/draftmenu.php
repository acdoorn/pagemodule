<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftmenu extends Eloquent {
    protected $table = 'menu_draft';

    public function draftmenuitems() {
    	$this->belongsToMany('Draftmenuitem', 'menu_has_menuitem_draft');
    }
}