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
?>
	<h2>Added in menus:</h2>
	@foreach($menus as $menu)
		<div id="link" class="btn btn-primary form-control" style="margin-bottom:5px;" name="menudiv">Menu: {{$menu->name}}
			<div id="submenu" style="display:none;" class="input-group form-control">
				@for($x = 1; $x <= $menu->draftmenuitems->count(); $x++)
					@foreach($menu->draftmenuitems as $menuitem)
						@if($x == $menuitem->pivot->order)
							<div class="btn btn-default form-control">Menuitem: {{(!is_null($menuitem->alias) ? $menuitem->alias : $menuitem->title)}} - Page: {{$menuitem->draftpage->name}}</div>
						@endif
					@endforeach
				@endfor
			</div>
		</div>
	@endforeach
	{{ HTML::script('packages/acdoorn/pagemodule/js/menu.js') }}
<?php } ?>

@stop