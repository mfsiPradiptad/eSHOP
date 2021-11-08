<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Mycart;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Repositories\ProductRepository;

class AddProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

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

            $id = $product->id;
            $msg = 'Product added sucessfully';
        }

        $path = $data['pImage']->storeAs(
            '/public/documents/product',
            $newName
        );

        $product = $this->getProduct($id);
        $result = array('product' => $product, 'msg' => $msg);
        return $result;
    }

    public function getProduct($id): array
    {
        if ($id != '') {
            $product = $this->productRepository->getProduct($id);
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
        $data = $this->productRepository->getAllProduct();
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
        $result = $this->productRepository->removeFromCart($data);
        $msg = 'Product remove from cart.';
        return $msg;
    }

    public function inMyCart(int $id)
    {
        $result = $this->productRepository->inMyCart($id);
        return $result;
    }

    public function updateCart(array $data): void
    {
        $userId = auth()->user()->id;
        $this->productRepository->updateCart($data, $userId);
    }

    public function findInCart(array $data): bool
    {
        $find = false;
        $result = $this->productRepository->findInCart($data);

        if (!empty($result)) {
            $find = true;
        }

        return $find;
    }

    public function checkOut(array $data): array
    {

        $name = trim($data['name']);
        $mobile = trim($data['mobile']);
        $address = trim($data['address']);
        $userId = auth()->user()->id;
        $totalAmount = $data['totalAmount'];
        $uniQueOrderId = uniqid('ESH');

        $order = OrderDetail::create([
            'textOrderId' => $uniQueOrderId,
            'intUserid' => $userId,
            'orderName' => $name,
            'orderMobile' => $mobile,
            'orderAddress' => $address,
            'intTotalAmount' => $totalAmount
        ]);

        $orderId = $order->textOrderId;
        $myCart = $this->inMyCart($userId);
        $cartList = array();
        $productList = array();
        $i = 0;
        $orderPlace = new Order();

        foreach ($myCart as $cart) {
            $amount = $cart['intQuantity'] * $cart['price'];
            $cartItems = array(
                'textOrderId' => $orderId,
                'productId' => $cart['productId'],
                'userId' => $cart['userId'],
                'intQuantity' => $cart['intQuantity'],
                'price' => $cart['price'],
                'totalAmount' => $amount
            );

            $i++;
            array_push($cartList, $cartItems);
            array_push($productList, $cart['productId']);

        }

        $error = 1;

        try {
            $orderPlace = Order::insert($cartList);
            $this->removeFromCartAftChekOut($productList);
            $error = 0;
            $msg = " Your order has been placed successfully. ";
        } catch (\Throwable $th) {
            $error = 2;
            $msg = " Error in placing Order. ";
        }

        $result = array('uniqueId' => $uniQueOrderId,
                    'error' => $error,
                    'msg' => $msg
                );

        return $result;
    }

    public function removeFromCartAftChekOut(array $data): void
    {
        $this->productRepository->removeFromCartAftChekOut($data);
    }

    public function allMyOrders(): array
    {
        $rows = $this->productRepository->allMyOrders();
        $result = $this->groupOrders($rows);
        return $result;
    }

    public function cancelOrder(string $txtOrderId)
    {
        $txtOrderId = trim($txtOrderId);
        $this->productRepository->cancelOrder($txtOrderId);
    }

    public function allOrders($id): array
    {
        $rows = $this->productRepository->allOrders($id);
        $result = $this->groupOrders($rows);
        return $result;
    }

    public function groupOrders(array $rows): array
    {
        $resultKeys = array();
        $result = array();

        foreach($rows as $row){
            array_push($resultKeys, $row['textOrderId']);
        }

        $resultKeys = array_unique($resultKeys);
        $i = 0;

        foreach($rows as $row){
            $key =$row['textOrderId'];
            $result[$key][$i++] = $row;
        }

        return $result;
    }
}
