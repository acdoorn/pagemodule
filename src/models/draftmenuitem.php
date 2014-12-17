<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftmenuitem extends Eloquent {
    protected $table = 'menuitem_draft';

    public function draftmenus() {
    	$this->belongsToMany('Draftmenu', 'menu_has_menuitem_draft');
    }
}