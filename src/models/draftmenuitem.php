<?php
namespace Acdoorn\Pagemodule;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Draftmenuitem extends Eloquent {
    protected $table = 'menuitem_draft';

    public function draftmenus() {
    	return $this->belongsToMany('Acdoorn\Pagemodule\Draftmenu', 'menu_has_menuitem_draft')->withPivot('order');
    }

    public function draftpage() {
    	return $this->belongsTo('Acdoorn\Pagemodule\Draftpage', 'draftpage_id');
    }
}