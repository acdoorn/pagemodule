@section('content')
<div class="col-md-6" role="main">
    <div class="bs-docs-section">
		<h1>General</h1>
		@if(isset($page))
		    {{ Form::model($page) }}
		@elseif(isset($draft))
		    {{ Form::model($draft) }}
	    	<?php if(isset($draft->drafturl->url)){} 
	    	 if(isset($draft->drafttemplate->code)){} 
	    	 if(isset($draft->drafturl->draftseoinfo->browsertitle)){} 
	    	 if(isset($draft->drafturl->draftseoinfo->keywords)){} 
	    	 if(isset($draft->drafturl->draftseoinfo->description)){} 
	    	 if(isset($draft->drafturl->draftseoinfo->google)){} 
	    	 	?>
		@else
			{{Form::open()/* error? */}}
		@endif
		<?php 
		$counter = 1;
		foreach($templates as $template) {
			$templatearray[$template->id] = 'Template '.$template->id;
		}

		?>

			<h3>About the page</h3>
			<div class="input-group">
			    <span class="input-group-addon">Pagename</span>
			{{ Form::text('name', Input::old('name'), ['placeholder' => 'Pagename', 'class'=>'form-control']) }}
			</div><br/>

			<div class="input-group">
			    <span class="input-group-addon">Enabled</span>
			{{ Form::checkbox('enabled', Input::old('enabled')) }}
			</div/><br/>

			{{ Form::label('template_id', 'Template') }}
			{{ Form::select('template_id', $templatearray, Input::old('templated_id')) }}
			<br/><br/>

			@if(isset($page))
			<h3>Seoinfo</h3>

			{{ Form::label('url[seoinfo][browsertitle]', 'Title') }}
			{{ Form::text('url[seoinfo][browsertitle]', Input::old('url[seoinfo][browsertitle]'), ['placeholder' => 'Browsertitle']) }}
			<br/><br/>

			{{ Form::label('url[seoinfo][keywords]', 'Keywords') }}
			{{ Form::text('url[seoinfo][keywords]', Input::old('url[seoinfo][keywords]'), ['placeholder' => 'Keywords']) }}
			<br/><br/>

			{{ Form::label('url[seoinfo][description]', 'Description') }}
			{{ Form::textarea('url[seoinfo][description]', Input::old('url[seoinfo][description]'), ['placeholder' => 'Description']) }}
			<br/><br/>

			{{ Form::label('url[seoinfo][google]', 'Google bots') }}
			{{ Form::select('url[seoinfo][google]', array('Index, tracking'=>'Index, tracking', 'Noindex, notracking' => 'Noindex, notracking'), Input::old('url[seoinfo][google]')) }}
			<br/><br/>

			{{ Form::label('url[seoinfo][URL]', 'URL') }}
			{{ Form::text('url[URL]', Input::old('url[URL]'), ['placeholder' => 'URL']) }}
			<br/><br/>

			@elseif(isset($draft))

			<h3>Seoinfo</h3>
			<div class="input-group">
			    <span class="input-group-addon">Browsertitle</span>
				{{ Form::text('drafturl[draftseoinfo][browsertitle]', Input::old('drafturl[draftseoinfo][browsertitle]'), ['placeholder' => 'Browsertitle', 'class'=>'form-control']) }}
			</div></br>

			{{ Form::label('drafturl[draftseoinfo][keywords]', 'Keywords') }}
			{{ Form::text('drafturl[draftseoinfo][keywords]', Input::old('drafturl[draftseoinfo][keywords]'), ['placeholder' => 'Keywords']) }}
			<br/><br/>

			{{ Form::label('drafturl[draftseoinfo][description]', 'Description') }}
			{{ Form::textarea('drafturl[draftseoinfo][description]', Input::old('drafturl[draftseoinfo][description]'), ['placeholder' => 'Description']) }}
			<br/><br/>

			{{ Form::label('drafturl[draftseoinfo][google]', 'Google bots') }}
			{{ Form::select('drafturl[draftseoinfo][google]', array('Index, tracking'=>'Index, tracking', 'Noindex, notracking' => 'Noindex, notracking'), Input::old('drafturl[draftseoinfo][google]')) }}
			<br/><br/>

			{{ Form::label('drafturl[URL]', 'URL') }}
			{{ Form::text('drafturl[URL]', Input::old('drafturl[URL]'), ['placeholder' => 'URL']) }}
			@endif
			{{ Form::submit('Save', array('style' =>'float:right; width:100px')) }}
		{{ Form::close() }}
    </div>
</div>
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('example')
    </div>
</div>
@stop