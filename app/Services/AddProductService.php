<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Mycart;
use App\Models\OrderDetail;
use App\Models\Order;


class AddProductService
{
    public function uploadProduct(array $data): array
    {
        $id = $data['id'];
        $fileOriginalName = $data['pImage']->getClientOriginalName();
        $file = explode('.', $fileOriginalName);
        $newName = $file[0] . '_' . time() . '.' . $file[1];
        $msg = '';

        if ($id != '') {
            $product = Product::where('id', $id)->update([
                'productName' => $data['pName'],
                'price' => $data['pPrice'],
                'quantity' => $data['pQuantity'],
                'description' =>  $data['pDesc'],
                'image' => $newName,
            ]);
            $msg = 'Product updated sucessfully';
        } else {
            $product = Product::create([
                'productName' =>  $data['pName'],
                'price' =>  $data['pPrice'],
                'quantity' =>  $data['pQuantity'],
                'description' =>  $data['pDesc'],
                'image' => $newName,
            ]);
            $msg = 'Product added sucessfully';
        }

        $path = $data['pImage']->storeAs(
            '/public/documents/product',
            $newName
        );

        $product = Product::where('id', $id)->get();
        $product = json_decode($product, true);
        $product[0]['submit'] = 'Update';
        $result = array('product' => $product, 'msg' => $msg);
        return $result;
    }

    public function getProduct($id): array
    {
        if ($id != '') {
            $product = Product::where('id', $id)->get();
            $product = json_decode($product, true);
            $product[0]['submit'] = 'Update';
        } else {
            $product = array();
            $product[0]['quantity'] = '';
            $product[0]['id'] = '';
            $product[0]['price'] = '';
            $product[0]['image'] = '';
            $product[0]['description'] = '';
            $product[0]['productName'] = '';
            $product[0]['submit'] = 'Add';
        }
        return $product;
    }

    public function getAllProduct(): array
    {
        $data = Product::get();
        $data = json_decode($data, true);
        return $data;
    }

    public function addToCart(array $data): string
    {
        $productId = (int) $data['productId'];
        $userId = (int) $data['userId'];
        $present = $this->findInCart($data);
        $msg = '';

        if (!$present) {
            $result = Mycart::create([
                'productId' => $productId,
                'userId' => $userId,
                'inCart' => 1
            ]);
            $result = json_decode($result, true);
            $msg = 'Product added to cart.';
        } else {
            $msg = 'Product has already added to cart.';
        }

        return $msg;
    }

    public function removeFromCart(array $data): string
    {
        $productId = (int) $data['productId'];
        $userId = (int) $data['userId'];
        $result = Mycart::where('productId', $productId)
            ->where('userId', $userId)
            ->where('inCart', 1)
            ->update(['inCart' => 0]);

        $msg = 'Product remove from cart.';
        return $msg;
    }

    public function inMyCart(int $id)
    {
        $result = Mycart::where('userId', $id)
                        ->where('inCart', 1)
                        ->rightJoin('product', 'mycart.productId', '=', 'product.id')
                        ->get();

        $result = json_decode($result, true);
        return $result;
    }

    public function updateCart(array $data): void
    {
        $id = $data['productId'];
        $quntity = $data['quantity'];
        $userId = auth()->user()->id;
        $result = Mycart::where('userId', $userId)
                        ->where('productId', $id)
                        ->where('inCart', 1)
                        ->update(['intQuantity' => $quntity]);

    }

    public function findInCart(array $data): bool
    {
        $find = false;
        $productId = (int) $data['productId'];
        $userId = (int) $data['userId'];
        $result = Mycart::where('productId', $productId)
            ->where('userId', $userId)
            ->where('inCart', 1)
            ->get();

        $result = json_decode($result, true);

        if (!empty($result)) {
            $find =true;
        }

        return $find;
    }

    public function checkOut(array $data)
    {
        $name = trim($data['name']);
        $mobile = trim($data['mobile']);
        $address = trim($data['address']);
        $userId = auth()->user()->id;
        $totalAmount = (int) $data['totalAmount'];

        $order = OrderDetail::create([
            'intUserid' => $userId,
            'orderName' => $name,
            'orderMobile' => $mobile,
            'orderAddress' => $address,
            'intTotalAmount' => $totalAmount
        ]);
        $orderId = $order->id;

        dd($order);

    }
}
