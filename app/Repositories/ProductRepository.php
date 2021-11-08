<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use App\Models\Mycart;
use App\Models\Product;

class ProductRepository
{
    public function getProduct(int $id): array
    {
        $product = Product::where('id', $id)->get();
        $product = json_decode($product, true);
        return $product;
    }

    public function getAllProduct(): array
    {
        $data = Product::get();
        $data = json_decode($data, true);
        return $data;
    }

    public function removeFromCart(array $data)
    {
        $productId = (int) $data['productId'];
        $userId = (int) $data['userId'];
        $result = Mycart::where('productId', $productId)
                        ->where('userId', $userId)
                        ->where('inCart', 1)
                        ->delete();

        return $result;
    }

    public function inMyCart(int $id): array
    {
        $result = Mycart::where('userId', $id)
                        ->where('inCart', 1)
                        ->rightJoin('product', 'mycart.productId', '=', 'product.id')
                        ->get();

        $result = json_decode($result, true);
        return $result;
    }

    public function updateCart(array $data, int $userId): void
    {
        $id = $data['productId'];
        $quntity = $data['quantity'];

        $result = Mycart::where('userId', $userId)
            ->where('productId', $id)
            ->where('inCart', 1)
            ->update(['intQuantity' => $quntity]);
    }

    public function findInCart(array $data): array
    {
        $productId = (int) $data['productId'];
        $userId = (int) $data['userId'];
        $result = Mycart::where('productId', $productId)
            ->where('userId', $userId)
            ->where('inCart', 1)
            ->get();

        $result = json_decode($result, true);
        return $result;
    }

    public function removeFromCartAftChekOut(array $data): void
    {
        $result = Mycart::whereIn('productId', $data)
            ->where('userId', auth()->user()->id)
            ->where('inCart', 1)
            ->delete();
    }

    public function allMyOrders(): array
    {
        $rows = OrderDetail::where('intUserid', auth()->user()->id)
        ->rightJoin('order','orderDetails.textOrderId', '=', 'order.textOrderId')
        ->rightJoin('product', 'order.productId', '=', 'product.id')
        ->orderBy('orderDetails.id','DESC')
        ->get();

        $rows =  json_decode($rows,true);
        return $rows;
    }

    public function cancelOrder(string $txtOrderId)
    {
        $result = OrderDetail::where('textOrderId', $txtOrderId)
                            ->where('intUserid', auth()->user()->id)
                            ->where('orderCancelStatus', 0)
                            ->update(['orderCancelStatus' => 1]);
    }

    public function allOrders($id = 0): array
    {
        $rows = OrderDetail::where('orderCancelStatus', $id)
                            ->rightJoin('order','orderDetails.textOrderId', '=', 'order.textOrderId')
                            ->rightJoin('product', 'order.productId', '=', 'product.id')
                            ->orderBy('orderDetails.id','DESC')
                            ->get();

        $rows =  json_decode($rows,true);
        return $rows;
    }

    public function searchProduct(string $strProduct): array
    {
        $rows = Product::where('description', 'like', '%' . $strProduct . '%')
                        ->orWhere('productName', 'like', '%' . $strProduct . '%')
                        ->get();

        $rows =  json_decode($rows,true);
        return $rows;
    }
}
