@section('content')
<div class="col-md-3" role="main">
</div>
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
			array_push($pagearray, 'Page '.$page->id.': '.$page->name);
		}
		?>
			{{ Form::submit('New draft', ['name'=>'newdraft','class'=>'form-control']) }}<br/><br/>
			{{ Form::select('draft', $draftarray, 0, ['class'=>'form-control']) }}
			{{ Form::submit("Select existing draft", ['name'=>'existingdraft','class'=>'form-control']) }}<br/><br/>
			{{ Form::select('page', $pagearray, 0, ['class'=>'form-control']) }}
			{{ Form::submit("Select existing page", ['name'=>'existingpage','class'=>'form-control']) }}
		{{ Form::close() }}
    </div>
</div>
@stop