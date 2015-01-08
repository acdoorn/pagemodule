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
		{{Form::open(['files' => true])}}
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
			  			if($module->value == 'article')
			  			  $value = ''. Form::model($article, ['files' => true]);
			  			elseif($module->value == 'news')
			  				$value = ''. Form::model($news, ['files' => true])?>
			  		@foreach($fields as $field) 
				  		<?php $fieldtype = $field->draftfieldtype;?>
			  			@if($fieldtype->name == 'text')
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::text($field->name, Input::old($field->name), ['placeholder' => ucwords($field->name), 'class'=>'form-control', 'required' => 'required']) .'</div><br/>'?>
			  			@elseif($fieldtype->name == 'textarea')
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::textarea($field->name, Input::old($field->name), ['placeholder' => ucwords($field->name), 'class'=>'form-control', 'style'=>'resize:none;', 'required' => 'required']) .'</div><br/>'?>
			  			@elseif($fieldtype->name == 'image') 
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::file($field->name, ['class'=>'form-control']) .'</div><br/>'
								?>
			  			@else
							<?php $value.= '<div class="input-group">
							    <span class="input-group-addon">'.ucwords($field->name).'</span>'
								. Form::text($field->name, Input::old($field->name), ['placeholder' => ucwords($field->name), 'class'=>'form-control', 'required' => 'required']) .'</div><br/>'?>
				  		@endif
			  		@endforeach
			  			<?php $value.=  Form::hidden('section[]', $module->id, ['class'=>'form-control']);?>
			  		<option value="{{{$value}}}">{{$module->name}}</option>
		  		@endforeach
		  	</select>
		  </div>
		  <div id="sectiontabs" style="float:left; min-width:80%; max-width:80%;">
			<ul>
			<?php $x = 1; ?>
			@foreach ($template->draftsections as $section)
				<li><a onclick="refreshchoose()" href="{{Request::url()}}#sectiontabs-{{$x}}">Section {{$x}}</a></li>
			<?php $x++; ?>
			@endforeach
			</ul>
			<?php $x = 1; ?>
			@foreach ($template->draftsections as $section)
				<div id="sectiontabs-{{$x}}"><div class="update" id="update{{$x}}">
					<?php 
						foreach($item->content as $content) {
							if($section->id == $content->draftsection_id) {
								if($content->article != null){
									if($content->article->madeby == $content->draftmodule){
										$articlearray = $content->article->toArray();?>
										<div class="input-group">
										    <span class="input-group-addon">{{ucwords('name')}}</span>
											{{Form::text('name'. $x, $articlearray['name'], ['placeholder' => ucwords($articlearray['name']), 'class'=>'form-control', 'required' => 'required'])}}
										</div><br/>
										<div class="input-group">
										    <span class="input-group-addon">
										    	{{ucwords('description')}}</span>
											{{Form::textarea('description'. $x, $articlearray['description'], ['placeholder' => ucwords($articlearray['description']), 'class'=>'form-control', 'style'=>'resize:none;', 'required' => 'required'])}} 
										</div><br/>
											@if($articlearray['image'])
												<span class="glyphicon glyphicon-ok"></span>Example of current image(displayed in 100 pixels):<img class="thumbnail" src="{{$articlearray['image']}}" width="100" height="100"/>
												<br/>
												{{Form::hidden('image'.$x, $articlearray['image'])}}
											@endif
											<div class="input-group">
										    <span class="input-group-addon">{{ucwords('image')}}</span>
										    {{Form::file('image'. $x, ['class'=>'form-control', 'value'=>$articlearray['image']])}}
										</div><br/>
										{{Form::hidden('article_id', $content->article->id)}}
										{{Form::hidden('section'.$x, $content->draftmodule->id)}}
								<?php
									}
								}
								if($content->news != null) {
									if($content->news->madeby == $content->draftmodule){
										$newsarray = $content->news->toArray();?>
									<div class="input-group">
									    <span class="input-group-addon">{{ucwords('title')}}</span>
										{{Form::text('title'. $x, $newsarray['title'], ['placeholder' => ucwords($newsarray['title']), 'class'=>'form-control', 'required' => 'required'])}}
									</div><br/>
									<div class="input-group">
									    <span class="input-group-addon">
									    	{{ucwords('content')}}</span>
										{{Form::textarea('content'. $x, $newsarray['content'], ['placeholder' => ucwords($newsarray['content']), 'class'=>'form-control', 'style'=>'resize:none;', 'required' => 'required'])}} 
									</div><br/>
									{{Form::hidden('news_id', $content->news->id)}}
									{{Form::hidden('section'.$x, $content->draftmodule->id)}}<?php
									}
								}
							}
						}?>
				</div></div>
			<?php $x++; ?>
			@endforeach
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

