@section('menu')
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#">Pagemodule</a>
	</div>
	@if(isset($draft) || isset($page))
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav">
    	<li <?=echoActiveClassIfRequestMatches("general");?>><?php echo '<a href="CMS/pagemodule/'.(isset($draft) ? 'draft' : 'page').'/'.(isset($draft) ? $draft->id : $page->id).'/general">General</a>';?></li>
    	<li <?=echoActiveClassIfRequestMatches("content");?>><?php echo '<a href="CMS/pagemodule/'.(isset($draft) ? 'draft' : 'page').'/'.(isset($draft) ? $draft->id : $page->id).'/content">Content</a>';?></li>
    	<li <?=echoActiveClassIfRequestMatches("menu");?>><?php echo '<a href="CMS/pagemodule/'.(isset($draft) ? 'draft' : 'page').'/'.(isset($draft) ? $draft->id : $page->id).'/menu">Menu</a>';?></li>
    	<li <?=echoActiveClassIfRequestMatches("summary");?>><?php echo '<a href="CMS/pagemodule/'.(isset($draft) ? 'draft' : 'page').'/'.(isset($draft) ? $draft->id : $page->id).'/summary">Summary</a>';?></li>
	</ul>
  	</div>
  	@endif
  </div>
</nav>

<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>
@stop
