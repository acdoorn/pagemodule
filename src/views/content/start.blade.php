@section('content')
<div class="col-md-6" role="main">
    <div class="bs-docs-section">
		{{Form::open()}}
		<?php 
		$draftarray = array();
		$pagearray = array();
		foreach($draftpages as $draft) {
			array_push($draftarray, 'Draft '.$draft->id.': '.(isset($draft->name) ? $draft->name : '--Name missing--'));
		}
		foreach($pages as $page) {
			array_push($pagearray, 'Draft '.$page->id.': '.$page->name);
		}

		?>
			{{ Form::submit('New draft', ['name'=>'newdraft']) }}<br/><br/>
			{{ Form::select('draft', $draftarray) }}
			{{ Form::submit('Select existing draft', ['name'=>'existingdraft']) }}<br/><br/>
			{{ Form::select('page', $pagearray) }}
			{{ Form::submit('Select existing page', ['name'=>'existingpage']) }}
		{{ Form::close() }}
    </div>
</div>
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('example')
    </div>
</div>
@stop