<?php

namespace App\Http\Controllers;

use App\Constants\Resources;
use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use App\Http\Resources\HomePageProductResource;
use App\Http\Services\ProductService;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function getHome()
    {
        $products = $this->productService->getHomePageProducts();

        $response = HomePageProductResource::make($products);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_PRODUCTS
        ));
    }
    public function getMostViewed()
    {
        $products = $this->productService->getAllMostViewedProducts();

        $response = ProductResource::collection($products);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_PRODUCTS
        ));
    }
    public function getMostPreferred()
    {
        $products = $this->productService->getAllMostPreferredProducts();

        $response = ProductResource::collection($products);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_PRODUCTS
        ));
    }
    public function getBestSeller()
    {
        $products = $this->productService->getAllBestSellerProducts();

        $response = ProductResource::collection($products);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_PRODUCTS
        ));
    }
    public function details(string $id)
    {
        $products = $this->productService->getProductDetails($id);

        $response = ProductResource::make($products);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_PRODUCT
        ));
    }
    public function search(Request $request)
    {
        $result = $this->productService->search($request->input('searchTerm'));

        $response = HomePageProductResource::make($result);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_SEARCH_RESULTS
        ));
    }
}
