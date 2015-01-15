@section('google')

<?php 
$title = $seoinfo->browsertitle;
$fronturl = "www.mijnnieuwewebsite.nl/voorbeeld";
$endurl = $url->URL;
$showurl = $fronturl.$endurl;
$description = $seoinfo->description;
?>





<h2>Google search example</h2>
<? //ripped css + layout from google with snippettool & simplified it a bit?>
<div id="DIV_1">
    <h3 id="H3_2">
        <a id="A_3">{{$title}}</a>
    </h3>
    <div id="DIV_4">
        <div id="DIV_5">
            <div id="DIV_6">
                <cite id="CITE_7">{{$showurl}}</cite>
                <div id="DIV_9">
                    <a id="A_10"><span id="SPAN_11"></span></a>
                </div>
            </div>
            <span id="SPAN_19">{{$description}}</span>
        </div>
    </div>
</div>
@stop