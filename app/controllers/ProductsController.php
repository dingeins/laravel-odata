<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of products
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Product::all();

		$data = array(
		'@odata.context' => Config::get('app.url').'/$metadata#'.ucfirst('products'),
		'value' => $data
		);

		$response = Response::json($data, 200);
		$response->header('OData-Version', '4.0');

    	return $response;
	}

	/**
	 * Store a newly created product in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$response = null;

		$validator = Validator::make($data = Input::all(), Product::$rules);

		if ($validator->fails()) {
			$response = Response::json(NULL, 500);
		}
		else{
			Product::create($data);
			$response = Response::json($data, 201);
		}

		$response->header('OData-Version', '4.0');
		return $response;
	}

	/**
	 * Display the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$response = null;

		$product = Product::find($id);
		if (empty($product)) {
			$response = Response::json(NULL, 404);
		} else {
			$data = array(
				'@odata.context' => Config::get('app.url') . '/$metadata#' . 'Products' . '/$entity',
				'value' => $product
			);
			$response = Response::json($data, 200);
		}

		$response->header('OData-Version', '4.0');
		return $response;
	}

	/**
	 * Update the specified product in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = Product::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Product::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$product->update($data);

		return Redirect::route('products.index');
	}

	/**
	 * Remove the specified product from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Product::destroy($id);

		$response = Response::make(NULL, 204);
		$response->header('OData-Version', '4.0');

		return $response;
	}

}
