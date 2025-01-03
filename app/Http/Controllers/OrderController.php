<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use App\Constants\Resources;
use App\Http\Services\OrderService;
use App\Http\Requests\AddOrderRequest;
use App\Http\Requests\ChangeOrderStatusRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {
    }

    public function addProductToOrder(AddOrderRequest $request)
    {
        $response = $this->orderService->addProductToOrder($request->validated());

        // dd($response);
        if($response == false)
        {
            return $this->notAllowedResponse(
                [],
                messageHandler(
                    ApiMessages::QUANTITY_NOT_AVAILABLE)
                );
        }
        return $this->okResponse(
            [],
            messageHandler(ApiMessages::MSG_SUCCESS)
        );
    }
    public function deleteProductFromOrder(UpdateOrderRequest $request)
    {
        $response = $this->orderService->deleteProductFormOrder($request->validated());

        if($response == false)
        {
            return $this->notAllowedResponse(
                [],
                messageHandler(
                    ApiMessages::ORDER_STATUS)
                );
        }

        return $this->okResponse(
            [],
            messageHandler(ApiMessages::MSG_SUCCESS)
        );
    }

    public function getCustomerOrders()
    {
        // dd(4);
        $orders = $this->orderService->getCustomerOrders();

        $response = OrderResource::collection($orders);

        return $this->okResponse(
            $response , 
            messageHandler(
                ApiMessages::MSG_SUCCESS , 
                Resources::RES_ORDERS
            )
        );
    }
    public function getCustomerOrderDetails(string $orderId)
    {
        $orders = $this->orderService->getCustomerOrderDetails($orderId);

        $response = OrderResource::make($orders);

        return $this->okResponse(
            $response , 
            messageHandler(
                ApiMessages::MSG_SUCCESS , 
                Resources::RES_ORDER
            )
        );
    }

    public function cancelOrder(string $orderId)
    {
        $response = $this->orderService->cancelOrder($orderId);

        if($response == false)
        {
            return $this->notAllowedResponse(
                [],
                messageHandler(
                    ApiMessages::ORDER_STATUS)
                );
        }

        return $this->okResponse(
            [],
            messageHandler(ApiMessages::MSG_SUCCESS)
        );
    }
    public function rejectOrder(string $orderId)
    {
        $response = $this->orderService->rejectOrder($orderId);order_id: 

        if($response == false)
        {
            return $this->notAllowedResponse(
                [],
                messageHandler(
                    ApiMessages::ORDER_STATUS)
                );
        }

        return $this->okResponse(
            [],
            messageHandler(ApiMessages::MSG_SUCCESS)
        );
    }

    public function changeOrderStatus(ChangeOrderStatusRequest $request)
    {
        $this->orderService->changeOrderStatus($request->validated());

        return $this->okResponse(
            [],
            messageHandler(ApiMessages::MSG_SUCCESS)
        );
    }

}
