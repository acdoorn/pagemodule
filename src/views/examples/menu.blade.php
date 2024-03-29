@section('menuexample')
<?php 
if($menuitems = $draft->draftmenuitems) {

$menus = array();
foreach($menuitems as $menuitem) {
	foreach($menuitem->draftmenus as $menu) {
		if(!array_key_exists($menu->id, $menus)){
			$menus[$menu->id] = $menu;
		}
	}
}
$value = '';

$parentarray = array();
foreach($menu->draftmenuitems as $menuitem) {
	if(isset($menuitem->pivot->parent)){
		$parentarray[$menuitem->pivot->parent] = (isset($parentarray[$menuitem->pivot->parent]) ? $parentarray[$menuitem->pivot->parent]+1 : 1);
	}
}
?>
	<h2>Added in menus:</h2>
	@foreach($menus as $menu)
		<div id="link" class="btn btn-primary form-control" style="margin-bottom:5px;" name="menudiv">Menu: {{$menu->name}}
			<ol id="submenu" style="display:none;" class="input-group form-control">
				{{loopExampleMenuitems($menu->draftmenuitems, $value, $parentarray, null)}}
			</ol>
		</div>

	@endforeach
<?php } 

				// loopExampleMenuitems($menu->draftmenuitems, $parentarray, null)
/*
				@for($x = 1; $x <= $menu->draftmenuitems->count(); $x++)
					@foreach($menu->draftmenuitems as $menuitem)
						@if($x == $menuitem->pivot->order)
							<div class="btn btn-default form-control">Menuitem: {{(!is_null($menuitem->alias) ? $menuitem->alias : $menuitem->title)}} - Page: {{$menuitem->draftpage->name}}</div>
						@endif
					@endforeach
				@endfor



*/


function loopExampleMenuitems($menuitems, $value, $parentarray, $parentid) {
	for($x = 1; $x <= $menuitems->count();$x++){
		foreach ($menuitems as $menuitem) {
			if($x == $menuitem->pivot->order) {
				if(!isset($parentid)) {
					if ($menuitem->pivot->parent == null) {
						$value .= '<li class="dd-item">
				    					<div class="btn btn-default form-control">'.(!is_null($menuitem->alias) ? $menuitem->alias : $menuitem->title) .'</div>';
						if(isset($parentarray[$menuitem->id])) {
							$value .= '<ol>';
							//for value in parentarray loopmenuitems $menuitems, $value, $parentarray, $parentid
							$value = loopExampleMenuitems($menuitems, $value, $parentarray, $menuitem->id);
							$value .= '</ol>';
						}
						else {

						}
						$value .= '</li>';
					}
				}
				else {
					if ($menuitem->pivot->parent == $parentid) {
						$value .= '<li class="dd-item">
				    					<div class="btn btn-default form-control">'.(!is_null($menuitem->alias) ? $menuitem->alias : $menuitem->title) .'</div>';
						if(isset($parentarray[$menuitem->id])) {
							$value .= '<ol>';
							//for value in parentarray loopmenuitems $menuitems, $value, $parentarray, $parentid
							$value = loopExampleMenuitems($menuitems, $value, $parentarray, $menuitem->id);
							$value .= '</ol>';
						}
						else {

						}
						$value .= '</li>';
					}

				}
			}
		}
	}
	return $value;
}?>

	{{ HTML::script('packages/acdoorn/pagemodule/js/menu.js') }}
@stop