@section('content')
<div class="col-md-6" role="main">
    <div class="bs-docs-section">
		<h1>Menu</h1>
		@foreach($article->getAttributes() as $attribute)
			{{$attribute}}
		@endforeach
    </div>
</div>
<div class="col-md-6">
    <div class="bs-docs-section">
        @yield('example')
    </div>
</div>
@stop