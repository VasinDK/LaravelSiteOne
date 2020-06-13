<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::group([], function(){  //'middleware'=>'web' не передаем, так как этот мидлвэа уже передается в сервиспровайдере RouteServiceProvider
	Route::match(['get', 'post'], '/', ['uses'=>'IndexController@execute', 'as'=>'home']);
	Route::get('/page/{alias}', ['uses'=>'PageController@execute', 'as'=>'page']);
	Route::auth();
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
	Route::get('/', function(){ 

		if(view()->exists('admin.index')){
			$data = ['title' => 'Панель администатора'];
			return view('admin.index', $data );
		};

	});

	Route::group(['prefix'=>'pages'], function(){
		Route::get('/',['uses'=>'PagesController@execute', 'as'=>'pages']);
		Route::match(['get','post'], '/add',['uses'=>'PagesAddController@execute', 'as'=>'pagesAdd']);
		Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses'=>'PagesEditController@execute', 'as'=>'pagesEdit']);
	});

	Route::group(['prefix'=>'portfolio'], function(){
		Route::get('/',['uses'=>'PortfolioController@execute', 'as'=>'portfolios']);
		Route::match(['get','post'], '/add',['uses'=>'PortfolioAddController@execute', 'as'=>'portfoliosAdd']);
		Route::match(['get', 'post', 'delete'], '/edit/{portfolio}', ['uses'=>'PortfolioEditController@execute', 'as'=>'portfoliosEdit']);
	});

	Route::group(['prefix'=>'service'], function(){
		Route::get('/',['uses'=>'ServiceController@execute', 'as'=>'services']);
		Route::match(['get','post'], '/add',['uses'=>'ServiceAddController@execute', 'as'=>'servicesAdd']);
		Route::match(['get', 'post', 'delete'], '/edit/{service}', ['uses'=>'ServiceEditController@execute', 'as'=>'servicesEdit']);
	});	
});
Route::auth();

Route::get('/home', 'HomeController@index');
