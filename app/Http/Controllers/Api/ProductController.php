<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * @param StoreProductRequest $request
     * @return mixed
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->additional(['message' => 'Product created successfully'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()
            ->json(['message' => 'Product deleted successfully'])
            ->setStatusCode(Response::HTTP_OK);
    }
}
