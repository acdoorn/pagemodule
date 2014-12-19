@section('content')
<div class="col-md-12" role="main">
    <div class="bs-docs-section">
		<h1>Content</h1>
		@if(isset($page))
    	 	<?php
				$item = $page;
		    	if(isset($item->template)){
		    	 	$template = $item->template;
		    	} 
	    	 ?>
		@elseif(isset($draft))
			<?php 
				$item = $draft;
		    	if(isset($item->drafttemplate)){
		    	 	$template = $item->drafttemplate;
		    	} 
	    	?>
		@else
			{{ Redirect::to('/')}}
		@endif

		    {{ Form::model($item, ['files'     => true]) }}
	    	<?php 
	    	 if(!isset($item->drafttemplate)){}; 
	    	 if(isset($item->drafttemplate)){
	    	 	$template = $item->drafttemplate;
	    	 } 
?>		  		
		<script type="text/javascript">
			$(function() {
				$( "#sectiontabs" ).tabs();
			});
		</script>
		 <div class="contentwrapper">
		  <div class="contentselect" style="float:left; min-width:20%; max-width:20%;">
		  	<select class="form-control" name="content[]" id="choose" style="width:100%;" size="5">
		  		@foreach($modules as $module)
			  		<?php $fields = $module->draftfields;
			  			  $value = '';?>
			  		@foreach($fields as $field) 
				  		<?php $fieldtype = $field->draftfieldtype;?>
			  			@if($fieldtype->name == 'text')
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::text($field->name, Input::old($field->name), ['placeholder' => ucwords($field->name), 'class'=>'form-control', 'required' => 'required']) .'</div><br/>'?>
						@endif
			  			@if($fieldtype->name == 'textarea')
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::textarea($field->name, Input::old($field->name), ['placeholder' => ucwords($field->name), 'class'=>'form-control', 'style'=>'resize:none;', 'required' => 'required']) .'</div><br/>'?>
						@endif
			  			@if($fieldtype->name == 'image') 
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::file($fieldtype->name, ['class'=>'form-control']) .'</div><br/>'
								?>
				  		@endif
			  		@endforeach
			  			<?php $value.=  Form::hidden('section[]', $module->id, ['class'=>'form-control']);?>
			  		<option value="{{{$value}}}">{{$module->name}}</option>
		  		@endforeach
		  	</select>
		  </div>
		  <div id="sectiontabs" style="float:left; min-width:80%; max-width:80%;">
			<ul>
			@for($x = 1;$template->draftsections->count() >= $x; $x++)
				<li><a onclick="refreshchoose()" href="{{Request::url()}}#sectiontabs-{{$x}}">Section {{$x}}</a></li>
			@endfor
			</ul>
			@for($x = 1;$template->draftsections->count() >= $x; $x++)
				<div id="sectiontabs-{{$x}}"><div class="update" id="update{{$x}}">Section {{$x}} is still empty</div></div>
			@endfor
		 </div>
			{{Form::submit('Save', ['class'=>'form-control btn-success'])}}
			{{Form::close()}}
		</div>
    </div>
</div>
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('example')
    </div>
</div>
	<script>
	$('#choose').change(function(event) {
	var alltabs = $(".update");
	for ( var x = 0; x < alltabs.length; x++ )
	{
		if($(alltabs[x]).is(":visible")) {
			$(alltabs[x]).html($('#choose').val());
		}
	}
}); </script>
  {{ HTML::script('packages/acdoorn/pagemodule/js/content.js') }}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

