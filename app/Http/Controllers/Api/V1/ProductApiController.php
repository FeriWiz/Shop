<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Services\keys;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/most_sold_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function mostSoldProduct()
    {
        return response()->json([
            'result'=>true,
            'message'=>'application home page',
            'data' => [
                keys::brands=>BrandResource::collection(Brand::all()),
                keys::most_sale_products => ProductRepository::getMostSoldProducts()
            ]
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/most_viewed_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function mostViewedProduct()
    {
        return response()->json([
            'result'=>true,
            'message'=>'application home page',
            'data' => [
                keys::brands=>BrandResource::collection(Brand::all()),
                keys::most_viewed_products => ProductRepository::getMostViewedProducts()->response()->getData(true),
            ]
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/newest_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function newestProduct()
    {
        return response()->json([
            'result'=>true,
            'message'=>'application home page',
            'data' => [
                keys::brands=>BrandResource::collection(Brand::all()),
                keys::newest_products => ProductRepository::getNewestProducts()->response()->getData(true),
            ]
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/cheapest_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function cheapestProduct()
    {
        return response()->json([
            'result'=>true,
            'message'=>'application home page',
            'data' => [
                keys::brands=>BrandResource::collection(Brand::all()),
                keys::cheapest_products => ProductRepository::getCheapestProducts()->response()->getData(true),
            ]
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/most_expensive_products",
     *  tags={"Products Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function mostExpensiveProduct()
    {
        return response()->json([
            'result'=>true,
            'message'=>'application home page',
            'data' => [
                keys::brands=>BrandResource::collection(Brand::all()),
                keys::most_expensive_products => ProductRepository::getMostExpensiveProducts()->response()->getData(true),
            ]
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/products_by_category/{id}",
     *  tags={"Products Page"},
     *  description="get products data by category id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsByCategory($id)
    {

        return response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data' => [
                keys::categories=>CategoryResource::collection(Category::all()),
                keys::products_by_category => ProductRepository::getProductsByCategory($id)->response()->getData(true),
            ]
        ]);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/products_by_brand/{id}",
     *  tags={"Products Page"},
     *  description="get products data by category id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsByBrand($id)
    {
        return response()->json([
            'result'=>true,
            'message'=>'application products page',
            'data' => [
                keys::brands=>BrandResource::collection(Brand::all()),
                keys::products_by_brand => ProductRepository::getProductsByBrand($id)->response()->getData(true),
            ]
        ]);
    }

}
