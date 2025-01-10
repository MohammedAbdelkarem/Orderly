<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Product;
use App\Constants\Resources;
use App\Enums\OrderStatusEnum;
use App\Http\Traits\ModelHelper;
use App\Models\OrderVariant;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService 
{
    public function addProductToOrder($data)
    {
        $product = ModelHelper::findByIdOrFail(Product::class , $data['product_id'] , 'male' , Resources::RES_PRODUCT); 
        $store = Store::find($product->store_id);

        if($product->quantity < $data['quantity'])
        {
            return false;
        }

        DB::beginTransaction();
        
        $customerCurrentOrder = Order::where('customer_id' , customer_id())
                            ->where('status' , OrderStatusEnum::PENDING)
                            ->first();
                            // dd($customerCurrentOrder);
        if($customerCurrentOrder == null)
        {
            $customerCurrentOrder = Order::create([
                'order_number'      => 'ORDER_' . uniqid(),
                'total_quantity'    => $data['quantity'],
                'total_price'       => $product->price * $data['quantity'],
                'customer_id'       => customer_id(),
                'store_id'          => $product->store_id
            ]);
            // dd(4);
        }
        else
        {
            // dd(4);
            $customerCurrentOrder->total_quantity += $data['quantity'];
            $customerCurrentOrder->total_price += $product->price * $data['quantity'];
            $customerCurrentOrder->save();
        }
        // dd(4);
        // dd($customerCurrentOrder);
        OrderVariant::create([
            'quantity'          => $data['quantity'],
            'total_price'       => $product->price * $data['quantity'],
            'order_id'          => $customerCurrentOrder->id,
            'product_id'        => $data['product_id'],
            'old_price'         => $product->price
        ]);
        // dd(4);
        $product->quantity -= $data['quantity'];
        $product->save();

        $store->number_of_orders -= $data['quantity'];
        $store->save();

        DB::commit();

        return true;
    }

    public function deleteProductFormOrder($data)
    {
        $product = ModelHelper::findByIdOrFail(Product::class , $data['product_id'] , 'male' , Resources::RES_PRODUCT); 
        $order = ModelHelper::findByIdOrFail(Order::class , $data['order_id'] , 'male' , Resources::RES_ORDER);
        $orderVariant = OrderVariant::where('order_id' , $data['order_id'])->where('product_id' , $data['product_id'])->first();

        if($order->status !== OrderStatusEnum::PENDING)
        {
            return false;
        }
        DB::beginTransaction();

        $order->total_quantity -= $orderVariant->quantity;
        $order->total_price -= $orderVariant->total_price;
        $order->save();

        $product->quantity += $orderVariant->quantity;
        $product->save();

        $orderVariant->delete();
        
        $orderVariant = OrderVariant::where('order_id' , $data['order_id'])->exists();

        if(! $orderVariant)
        {
            $order->delete();
        }

        DB::commit();

        return true;
    }

    public function getCustomerOrders()
    {
        $orders = Order::where('customer_id' , customer_id())->get();

        return $orders;
    }

    public function getCustomerOrderDetails($order_id)
    {
        $details = ModelHelper::findByIdOrFail(Order::class , $order_id , 'male' , Resources::RES_ORDER);

        return $details;
    }

    public function cancelOrder($order_id)
    {
        $order = ModelHelper::findByIdOrFail(Order::class , $order_id , 'male' , Resources::RES_ORDER);

        if($order->status !== OrderStatusEnum::PENDING)
        {
            return false;
        }

        $this->destroyOrder($order_id , OrderStatusEnum::CANCELLED);

        return true;
    }

    public function rejectOrder($order_id)
    {
        $order = ModelHelper::findByIdOrFail(Order::class , $order_id , 'male' , Resources::RES_ORDER);

        if($order->status !== OrderStatusEnum::PENDING)
        {
            return false;
        }

        $this->destroyOrder($order_id , OrderStatusEnum::REJECTED);

        return true;
    }

    public function submitOrder($order_id)
    {
        $order = ModelHelper::findByIdOrFail(Order::class , $order_id , 'male' , Resources::RES_ORDER);

        if($order->status != OrderStatusEnum::PENDING)
        {
            return false;
        }

        $order->status = OrderStatusEnum::PREAPERING;
        $order->save();

        return true;
    }

    public function changeOrderStatus($data)
    {
        $order = ModelHelper::findByIdOrFail(Order::class , $data['order_id'] , 'male'  , Resources::RES_ORDER);

        if($data['status'] == OrderStatusEnum::REJECTED || $data['status'] == OrderStatusEnum::CANCELLED)
        {
            $this->destroyOrder($data['order_id'] , $data['status']);
        }

        $order->status = $data['status'];
        $order->save();
    }

    public function destroyOrder($order_id , $status)
    {
        $order = ModelHelper::findByIdOrFail(Order::class , $order_id , 'male' , Resources::RES_ORDER);

        $variants = OrderVariant::where('order_id' , $order_id)->get();

        DB::beginTransaction();

        foreach($variants as $var)
        {
            $product = Product::find($var->product_id);

            $product->quantity += $var->quantity;
            $product->save();
        }

        $order->status = $status;
        $order->save();

        DB::commit();
    }
}
