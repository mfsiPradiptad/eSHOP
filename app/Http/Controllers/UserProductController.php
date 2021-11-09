<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddProductService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UserProductController extends Controller
{
    public  $productService;

    public function __construct()
    {
        $this->productService = new AddProductService();
    }

    public function index()
    {
        $searchFilters = array(
            'productName' => '',
            'selectCat' => 0,
            'selectFor' => 0,
        );
        $result = $this->productService->getAllProduct();
        return view('user.home', ['data' => $result, 'searchFilters' => $searchFilters]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->id;
        $userId = auth()->user()->id;
        $data = array('productId' => $productId, 'userId' => $userId);
        $result = $this->productService->addToCart($data);
        return json_encode(array('msg' => $result));
    }

    public function removeFromCart(Request $request)
    {
        $data = array('productId' => $request->id, 'userId' => auth()->user()->id);
        $result = $this->productService->removeFromCart($data);
        return json_encode(array('msg' => $result));
    }

    public function updateCart(Request $request)
    {
        $data = array('productId' => $request->id, 'quantity' => $request->quantity);
        $this->productService->updateCart($data);
    }

    public function viewCart()
    {
        $result = $this->productService->inMyCart(auth()->user()->id);
        return view('user.myCart', ['data' => $result]);
    }

    public function checkOutIndex($amount = 0)
    {
        $amount = (int) Crypt::decryptString($amount);
        return view('user.checkOut', ['amount' => $amount]);
    }

    public function checkOut(Request $request)
    {
        $data = (array) $request->all();
        $result = $this->productService->checkOut($data);

        return view('user.orderPlace',['data' => $result]);
    }

    public function allMyOrders()
    {
        $result = $this->productService->allMyOrders();
        return view('user.myOrders',['result' => $result]);
    }

    public function cancelOrder(Request $request)
    {
        $txtOrderId = $request->id;
        $this->productService->cancelOrder($txtOrderId);
    }

    public function searchProduct(Request $request)
    {
        $selectCat = ($request->selectCat > 0) ? $request->selectCat : 0;
        $selectFor = ($request->selectFor > 0) ? $request->selectFor : 0;
        $productName = ($request->searchProduct != '') ? htmlspecialchars($request->searchProduct) : '';
        $searchFilters = array(
            'productName' => $productName,
            'selectCat' => $selectCat,
            'selectFor' => $selectFor,
        );
        $result = $this->productService->searchProduct($searchFilters);
        return view('user.home', ['data' => $result, 'searchFilters' => $searchFilters]);
    }
}
