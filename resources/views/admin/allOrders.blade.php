@include('admin.header')

<div class="container ">

    <div class="row d-flex justify-content-center align-items-center mb-5">
        @if (empty($result ))
        <p class="text-center h2 font-weight-bold text-primary col-sm-12">No new orders made yet. </p>
        <div>
            <a href="/productList" class="btn btn-lg text-white bg-success col-sm-12">Go back</a>
        </div>
        @else

        <div class="table-responsive-sm bg-light font-weight-bold">
            <p class="h2 bg-warning text-white text-center">
                @if ($id == 0)
                    Placed Orders
                @else
                    Cancelled Orders
                @endif
            </p>

            <table class="table">
                <thead>
                    <th>Order</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Total Amount</th>
                </thead>
                    <tbody>
                        @foreach ($result as $key => $order)
                                <tr>
                                    <td><p class="h4 text-primary">Order id : {{$key}}</p></td>

                                </tr>

                                @foreach ($order as $product)
                                <tr>
                                    <td><img src="{{asset('storage/documents/product/'.$product['image']) }}" alt="image" height="100px" width="100px"></td>
                                    <td class="text-primary">{{$product['productName']}} <br> {{$product['description']}}</td>
                                    <td> <span class="text-success">&#x20B9; {{$product['price']}}</span>  <br> Quantity: {{$product['intQuantity']}} </td>
                                    <td class="text-success">&#x20B9; {{$product['totalAmount']}}</td>

                                </tr>
                                @endforeach
                                <tr class="h5">
                                    <td colspan="2">
                                        <span class="text-primary"> Address: </span> <p> {{$product['orderName']}}, {{$product['orderMobile']}}, {{$product['orderAddress']}}</p>
                                    </td>
                                    <td class="text-right" colspan="2"> <span class="text-primary">Order Amount:</span> <span class="text-success">&#x20B9; {{$product['intTotalAmount']}}</span></td>
                                </tr>

                        @endforeach
                </tbody>
            </table>
        </div>
    @endif
    </div>
</div>


<script>
    $(".cancelBtn").on('click', function () {
        var cancelId = $(this).closest('td').find('.canceltextId');
        var cancelVal = cancelId.val();
        cancelOrder(cancelVal);
        alert('Your order has been cancelled');
        window.location.href = '/myOrders';
    });
</script>
