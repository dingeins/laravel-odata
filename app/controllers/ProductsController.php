<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of products
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();

		$products = array(
			'@odata.context' => Config::get('app.url').'/$metadata#'.ucfirst('products'),
			'value' => $products
		);

		$response = Response::make($products, 200);
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
			$response = Response::make(NULL, 500);
		}
		else{
			$data = Product::create($data);
			$response = Response::make($data, 201);
			$response->header('Location', Config::get('app.url').'/Products/'.$data->id);
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
			$response = Response::make(NULL, 404);
		} else {
			$data = array(
				'@odata.context' => Config::get('app.url') . '/$metadata#' . 'Products' . '/$entity',
				'value' => $product
			);
			$response = Response::make($data, 200);
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
		$response = null;

		$product = Product::find($id);

		if (empty($product)) {
			$response = Response::make(NULL, 404);
		} else {
			$validator = Validator::make($data = Input::all(), Product::$rules);

			if ($validator->fails())
			{
				$response = Response::make(NULL, 500);
			}

			$product->update($data);
			$response = Response::make(NULL, 204);
		}

		$response->header('OData-Version', '4.0');
		return $response;
	}

	/**
	 * Remove the specified product from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$response = null;

		$product = Product::find($id);
		if (empty($product)) {
			$response = Response::make(NULL, 404);
		} else {
			Product::destroy($id);
			$response = Response::make(NULL, 204);
		}

		$response->header('OData-Version', '4.0');
		return $response;
	}

}
