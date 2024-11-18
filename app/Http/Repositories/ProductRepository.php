<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository
{
    public static function get6AmazingProducts()
    {
        $products = Product::query()->where('is_special', true)
            ->orderBy('discount', 'DESC')->take(6)->get();

        return ProductResource::collection($products);

    }

    public static function get6MostSoldProducts()
    {
        $products = Product::query()->orderBy('sold', 'DESC')->take(6)->get();

        return ProductResource::collection($products);
    }

    public static function getMostSoldProducts()
    {
        $products = Product::query()->orderBy('sold', 'DESC')->paginate(10);

        return ProductResource::collection($products);
    }

    public static function getMostViewedProducts()
    {
        $products = Product::query()->orderBy('review', 'DESC')->paginate(10);

        return ProductResource::collection($products);
    }

    public static function get6NewestProducts()
    {
        $products = Product::query()->latest()->take(6)->get();

        return ProductResource::collection($products);
    }

    public static function getNewestProducts()
    {
        $products = Product::query()->latest()->paginate(10);

        return ProductResource::collection($products);
    }

    public static function getCheapestProducts()
    {
        $products = Product::query()->orderBy('price', 'ASC')->paginate(10);

        return ProductResource::collection($products);
    }

    public static function getMostExpensiveProducts()
    {
        $products = Product::query()->orderBy('price', 'DESC')->paginate(10);

        return ProductResource::collection($products);
    }

    public static function getProductsByCategory($category)
    {
        $products = Product::query()->where('category_id', $category)->paginate(10);

        return ProductResource::collection($products);
    }

    public static function getProductsByBrand($brand)
    {
        $products = Product::query()->where('category_id', $brand)->paginate(10);

        return ProductResource::collection($products);
    }
}
