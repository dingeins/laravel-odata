<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('Products', 'ProductsController');

Route::get('/', function()
{
	$array = array(
		'@odata.context'=>Config::get('app.url').'/$metadata',
		'value' => array(
			array(
				'name'=>'Products',
				'kind'=>'EntitySet',
				'url'=>'Products'
			)
		)
	);
	return $array;
});



