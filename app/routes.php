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

// Route::get('/', function()
// {
// 	return "Service document";
// });

// Route::get('/Products', function()
// {
// 	$table = DB::table('products')->get();
// 	$result = array(
// 		"@odata.context" => Config::get("app.url")."/\$metadata#"."Products",
// 		"value" => $table
// 		);

//     return $result;
// });

// Route::get('/Products({id})', function($id)
// {
// 	$table = DB::table('products')->where("ID",$id)->get();
// 	$result = array(
// 		"@odata.context" => Config::get("app.url")."/\$metadata#"."Products"."/\$entity",
// 		"value" => $table
// 		);

//     return $result;
// });

// Route::delete('/Products({id})', function($id)
// {
// 	$item = DB::table('products')->where("ID",$id)->get();
// 	if(empty($item))
// 	{
// 		return Response::make(NULL, 404);
// 	}
// 	else
// 	{
// 		$status = DB::table('products')->delete($id);
// 		return Response::make(NULL, 204);
// 	}
// });


