<?php
App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $e)
{
    return Response::make('Model Not Found', 404);
});
App::error(function(Illuminate\Database\QueryException $e)
{
    return Response::make('Not Found, ' . $e->errorInfo['2'], 404);
});

Route::get('/', function() {
	return Redirect::to('/CMS/pagemodule');
});

Route::get('/CMS/pagemodule', 'Acdoorn\Pagemodule\HomeController@showStart');
Route::post('/CMS/pagemodule/', 'Acdoorn\Pagemodule\FormController@handleStart');

Route::group(array('prefix' => '/CMS/pagemodule/page/{pageid}'), function() {
	Route::get('/general', 'Acdoorn\Pagemodule\HomeController@showGeneral');
	Route::get('/content', 'Acdoorn\Pagemodule\HomeController@showContent');
	Route::get('/menu', 'Acdoorn\Pagemodule\HomeController@showMenu');
	Route::get('/summary', 'Acdoorn\Pagemodule\HomeController@showSummary');
	Route::post('/{step}', 'Acdoorn\Pagemodule\FormController@updatePage');
});
Route::group(array('prefix' => '/CMS/pagemodule/draft/{draftpageid}'), function() {
	Route::get('/general', 'Acdoorn\Pagemodule\HomeController@showGeneral');
	Route::get('/content', 'Acdoorn\Pagemodule\HomeController@showContent');
	Route::get('/menu', 'Acdoorn\Pagemodule\HomeController@showMenu');
	Route::get('/summary', 'Acdoorn\Pagemodule\HomeController@showSummary');
	Route::post('/{step}', 'Acdoorn\Pagemodule\FormController@updateDraft');
});
