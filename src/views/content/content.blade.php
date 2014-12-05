@section('content')
<div class="col-md-6" role="main">
    <div class="bs-docs-section">
		<h1>Content</h1>
		<?php 
		$availablecontent = array();
	 	foreach($content as $singlecontent) {
	 		
	 		if(true)
				$availablecontent[$singlecontent->id] = $singlecontent->name;
		}
		?>
		@if(isset($page))
		    {{ Form::model($page) }}
		@elseif(isset($draft))
		    {{ Form::model($draft) }}
	    	<?php 
	    	 if(!isset($draft->drafttemplate)){ var_dump($draft->$drafttemplate);} 
	    	 if(isset($draft->drafttemplate)){} 
	    	 	?>
		@else
			{{Form::open()/* error? */}}
		@endif

		<script type="text/javascript">
			$(function() {
				$( "#sectiontabs" ).tabs();
			});
		</script>
		 <div class="contentwrapper">
		  <div class="contentselect">
		  	{{ Form::select('content[]', $availablecontent, 0, array('id' => 'choose','multiple'))}}
			</select>
		  </div>
		  <div id="sectiontabs">
			<ul>
				<?php $template = 2?>
			@for($x = 1;$template >= $x; $x++)
				<li><a href="{{Request::url()}}#sectiontabs-{{$x}}">Section {{$x}}</a></li>
			@endfor
			</ul>
			@for($x = 1;$template >= $x; $x++)
				<div id="sectiontabs-{{$x}}"><div class="update" id="update{{$x}}">{{$x}}</div></div>
			@endfor
			{{Form::close()}}
		 </div>
		</div>
    </div>
</div>
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('example')
    </div>
</div>

  {{ HTML::script('packages/acdoorn/pagemodule/js/content.js') }}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop

