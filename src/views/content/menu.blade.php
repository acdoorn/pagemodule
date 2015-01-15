@section('content')
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<h1>Menu</h1>
	<div class="col-md-6" role="main">
	    <div class="bs-docs-section">
			<h3>Add to Menu <span id="menuhelp" class="glyphicon glyphicon-question-sign unselectable" style="font-size:15px; top:-2px; z-index: 1;"><div class="well" style="display:none; position:absolute; top:-2px; left:-1px; width:250px; padding:11px;">To add a new Menu select 'New menu' and drag the button for the current page down.</div></span></h3>
			{{Form::open()}}
			<select class="form-control" name="menuOptions[]" id="choose">
					<option disabled selected>--Choose menu--</option>
				@foreach($menus as $menu)
					<?php 
					$order = '';
						$value = '<div class="dd" style="max-width:100%;width:100%;;"><ol class="dd-list">
							  <li class="btn btn-default selectable dd-item" data-id="99999" value="new">
							  	<div class="dd-handle btn" id="editable">'.$draft->name.'</div>
			                  </li><br/>';
                    ?>
					@for($x = 1; $x <= $menu->draftmenuitems->count(); $x++)
						@foreach($menu->draftmenuitems as $menuitem) 
							@if($x == $menuitem->pivot->order)
								<?php 
								if($x != $menu->draftmenuitems->count())
									$order .= $menuitem->id . ',';
								else {
									$order .= $menuitem->id;
								}
								$value .= '<li class="selectable dd-item" data-id="'.$menuitem->id.'">
									<div class="btn btn-default form-control dd-handle">'.(!is_null($menuitem->alias) ? $menuitem->alias : $menuitem->title) .'</div>
									</li>';?>
							@endif
						@endforeach
					@endfor
					<?php 
						if($order == '') {
							$value .= '<p>This menu is currently empty; to add the current page to this menu drag the button for this page here.</p>';
						}
						$value .= '</ol></div>';
					?>
					<option value='<input type="hidden" value="{{$menu->id}}" name="menu_id"/>
						<input type="hidden" value="{{$order}}" id="oldorder" name="oldorder{{$menu->id}}"/>
						<input type="hidden" value="{{$order}}" id="neworder" name="neworder{{$menu->id}}"/>
						<div class="input-group" style="margin-top:5px;" id="menuitemname">
							<span class="input-group-addon" id="sizing-addon">Change menuitem name:</span>
							<input type="text" class="form-control" placeholder="{{$draft->name}}" name="changename" id="changename" aria-describedby="sizing-addon"/>
						</div>
							{{$value.Form::submit("Save", ["class"=>"form-control btn-success"])}}'>{{$menu->name}}</option>

				@endforeach
				<?php 
				$menupositionhtml = array();
				foreach($menupositions as $menuposition) {
					$menupositionhtml[$menuposition->id] = $menuposition->position;
				}
				$newmenuvalue = '<input type="hidden" value="99999" id="neworder" name="newmenu"/>
						<div class="input-group" style="margin-top:5px;" id="menuname">
							<span class="input-group-addon" id="sizing-addon">Menu name:</span>
							<input type="text" class="form-control" placeholder="Navigation" name="newmenuname" aria-describedby="sizing-addon" required/>
						</div>
						<div class="input-group" style="margin-top:5px; margin-bottom:10px;" id="menuposition">
							<span class="input-group-addon" id="sizing-addon">Menu Position:</span>'.
							Form::select("menuposition", $menupositionhtml, null, array("class" => "form-control", "required")).'
						</div>
						<div class="input-group" style="margin-top:5px;" id="menuitemname">
							<span class="input-group-addon" id="sizing-addon">Change menuitem name:</span>
							<input type="text" class="form-control" placeholder="'.$draft->name.'" name="changename" id="changename" aria-describedby="sizing-addon"/>
						</div>
						<div class="dd" style="max-width:100%;width:100%;;"><ol class="dd-list">
							  <li class="btn btn-default selectable dd-item" data-id="99999" value="new">
							  	<div class="dd-handle btn" id="editable">'.$draft->name.'</div>
			                  </li><br/><p>This menu is currently empty; to add the current page to this menu drag the button for this page here.</p></ol></div>';
				?>
				<option value='{{$newmenuvalue.Form::submit("Create and Save", ["class"=>"form-control btn-success"])}}'>New Menu</option>
			</select>
			<div class="editmenudiv" id="editmenudiv">
			</div>
			{{Form::close()}}
	    </div>
	</div>
	{{ HTML::script('packages/acdoorn/pagemodule/js/menu.js') }}
	{{ HTML::script('packages/acdoorn/pagemodule/js/jquery-sortable.js') }}
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('menuexample')
    </div>
</div>
@stop