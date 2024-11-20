<?php

namespace App\Http\Repositories;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class UserRepository
{
    public static function receiverUserOrder($user)
    {
        $order = Order::query()->whereHas('orderDetails',
            function ($query) {
                return $query->where('status', OrderStatus::Received->value);
            })->where('user_id', $user->id)->where('status', PaymentStatus::Success->value)->get();

        return orderResource::collection($order);
    }

    public static function receiverUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails',
            function ($query) {
                return $query->where('status', OrderStatus::Received->value);
            })->where('user_id', $user->id)->where('status', PaymentStatus::Success->value)->count();
    }

    public static function processingUserOrder($user)
    {
        $order = Order::query()->whereHas('orderDetails',
            function ($query) {
                return $query->where('status', OrderStatus::Processing->value);
            })->where('user_id', $user->id)->where('status', PaymentStatus::Success->value)->get();

        return orderResource::collection($order);
    }

    public static function processingUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails',
            function ($query) {
                return $query->where('status', OrderStatus::Processing->value);
            })->where('user_id', $user->id)->where('status', PaymentStatus::Success->value)->count();
    }

    public static function rejectedUserOrder($user)
    {
        $order = Order::query()->whereHas('orderDetails',
            function ($query) {
                return $query->where('status', OrderStatus::Received->value);
            })->where('user_id', $user->id)->where('status', PaymentStatus::Success->value)->get();

        return orderResource::collection($order);
    }

    public static function rejectedUserOrderCount($user)
    {
        return Order::query()->whereHas('orderDetails',
            function ($query) {
                return $query->where('status', OrderStatus::Rejected->value);
            })->where('user_id', $user->id)->where('status', PaymentStatus::Success->value)->count();
    }
}
