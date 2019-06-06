<?php

namespace App\Http\Controllers;

use App\Http\Resources\Series\SeriesResource;
use App\Model\Product;
use function retry;

class SeriesController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Model\Product $product
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(Product $product)
	{
		return SeriesResource ::collection($product -> series);
	}
	
	public function show(Product $product)
	{
		return new SeriesResource($product);
	}
}
