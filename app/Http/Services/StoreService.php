<?php

namespace App\Http\Services;

use App\Models\Store;

class StoreService extends BaseService 
{
    public function getHomePageStores()
    {
        $stores = Store::with('media')->take(8)->get();

        return $stores;
    }

    public function getAllStores()
    {
        $stores = Store::with('media')->get();

        return $stores;
    }

    public function getStoreDetails($id)
    {
        return Store::with(['media', 'products'])->find($id);
    }


}
