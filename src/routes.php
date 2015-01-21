<?php
App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $e)
{
    return Redirect::action('Acdoorn\Pagemodule\ErrorController@showError', array('404'));
});
App::error(function(Illuminate\Database\QueryException $e)
{
    return Redirect::action('Acdoorn\Pagemodule\ErrorController@showError', array('404'));
});
App::error(function(Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e)
{
    return Redirect::action('Acdoorn\Pagemodule\ErrorController@showError', array('404'));
});

Route::get('/error/{errorcode}', 'Acdoorn\Pagemodule\ErrorController@showError');


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

App::missing(function($e)
{
    return Redirect::action('Acdoorn\Pagemodule\ErrorController@showError', array('404'));
});