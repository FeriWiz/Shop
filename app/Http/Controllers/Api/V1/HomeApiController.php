<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SliderResource;
use App\Http\Services\keys;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/home",
     *  tags={"Home Page"},
     *  description="get home page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function home()
    {
        return response()->json([
            'result' => true,
            'message' => 'Application home page',
            'data' => [
                keys::sliders => SliderResource::collection(Slider::all()),
                keys::categories => CategoryResource::collection(Category::all()),
                keys::banner => Slider::query()->inRandomOrder()->first(),
                keys::amazing_products => ProductRepository::get6AmazingProducts(),
                keys::most_sale_products => ProductRepository::get6MostSoldProducts(),
                keys::newest_products => ProductRepository::get6NewestProducts(),
            ]
        ], 200);
    }
}
