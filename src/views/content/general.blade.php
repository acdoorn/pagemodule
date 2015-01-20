@section('content')
<h1>General</h1>
<div class="col-md-6" role="main">
    <div class="bs-docs-section">
		@if(isset($page))
		    {{ Form::model($page) }}
		@elseif(isset($draft))
		    {{ Form::model($draft) }}
		@else
		<!-- error -->
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
			{{ Form::checkbox('enabled', Input::old('enabled'), 0, ['class'=>'checkbox form-control']) }}
			</div/><br/>

			<div class="input-group">
			    <span class="input-group-addon">Template</span>
			{{ Form::select('template_id', $templatearray, Input::old('templated_id'), ['class'=>'form-control']) }}
			</div/><br/>

			@if(isset($page))
			<h3>Seoinfo</h3>
			<div class="input-group">
			    <span class="input-group-addon">Browsertitle</span>
			{{ Form::text('url[seoinfo][browsertitle]', Input::old('url[seoinfo][browsertitle]'), ['placeholder' => 'Browsertitle', 'class' => 'form-control', 'size'=>'55']) }}
			<br/><br/>

			<div class="input-group">
			    <span class="input-group-addon">Keywords</span>
			{{ Form::text('url[seoinfo][keywords]', Input::old('url[seoinfo][keywords]'), ['placeholder' => 'Keywords', 'class' => 'form-control']) }}
			<br/><br/>

			<div class="input-group">
			    <span class="input-group-addon">Description</span>
			{{ Form::textarea('url[seoinfo][description]', Input::old('url[seoinfo][description]'), ['placeholder' => 'Description', 'class' => 'form-control', 'rows'=>'5', 'max-length'=>'115']) }}
			<br/><br/>

			<div class="input-group">
			    <span class="input-group-addon">Google Bots</span>
			{{ Form::select('url[seoinfo][google]', array('Index, tracking'=>'Index, tracking', 'Noindex, notracking' => 'Noindex, notracking'), Input::old('url[seoinfo][google]', 1, ['class' => 'form-control'])) }}
			<br/><br/>

			<div class="input-group">
			    <span class="input-group-addon">URL</span>
			{{ Form::text('url[URL]', Input::old('url[URL]'), ['placeholder' => 'URL', 'class' => 'form-control']) }}
			</div>

			@elseif(isset($draft))

			<h3>Seoinfo</h3>
			<div class="input-group">
			    <span class="input-group-addon">Browsertitle</span>
				{{ Form::text('drafturl[draftseoinfo][browsertitle]', Input::old('drafturl[draftseoinfo][browsertitle]'), ['placeholder' => 'Browsertitle', 'class' => 'form-control', 'size'=>'55']) }}
			</div></br>

			<div class="input-group">
			    <span class="input-group-addon">Keywords</span>
			{{ Form::text('drafturl[draftseoinfo][keywords]', Input::old('drafturl[draftseoinfo][keywords]'), ['placeholder' => 'Keywords', 'class'=>'form-control']) }}
			</div></br>

			<div class="input-group">
			    <span class="input-group-addon">Description</span>
			{{ Form::textarea('drafturl[draftseoinfo][description]', Input::old('drafturl[draftseoinfo][description]'), ['placeholder' => 'Description', 'class'=>'form-control', 'rows'=>'5', 'max-length'=>'115']) }}
			</div></br>

			<div class="input-group">
			    <span class="input-group-addon">Google bots</span>
			{{ Form::select('drafturl[draftseoinfo][google]', array('Index, tracking'=>'Index, tracking', 'Noindex, notracking' => 'Noindex, notracking'), Input::old('drafturl[draftseoinfo][google]'), ['class'=>'form-control']) }}
			</div></br>

			<div class="input-group">
			    <span class="input-group-addon">URL</span>
			{{ Form::text('drafturl[URL]', Input::old('drafturl[URL]'), ['placeholder' => 'URL', 'class'=>'form-control']) }}
			</div></br>
			@endif
			{{ Form::submit('Save', array('class'=>'form-control btn-success')) }}
		{{ Form::close() }}
    </div>
</div>
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('google')
    </div>
</div>
@stop