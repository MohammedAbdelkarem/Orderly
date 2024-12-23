<?php

namespace App\Http\Controllers;

use App\Constants\Resources;
use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use App\Http\Services\StoreService;
use App\Http\Resources\StoreResource;

class StoreController extends Controller
{
    public function __construct(
        protected StoreService $storeService
    ) {
    }

    public function getHome()
    {
        $stores = $this->storeService->getHomePageStores();

        $response = StoreResource::collection($stores);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_STORES
        ));
    }
    public function getAll()
    {
        $stores = $this->storeService->getAllStores();

        $response = StoreResource::collection($stores);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_STORES
        ));
    }
    public function details(string $id)
    {
        $store = $this->storeService->getStoreDetails($id);

        $response = StoreResource::make($store);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_STORE
        ));
    }
}
