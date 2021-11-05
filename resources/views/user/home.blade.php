@include('user.userHeader')
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center bg-light">
            <table class="table table-borderd">
                <tbody>
                    @foreach ( $data as $product)
                       <tr>
                        <td><img src="{{asset('storage/documents/product/'.$product['image']) }}" alt="image" height="100px" width="100px"></td>
                        <td>
                            <span class="text-primary font-weight-bold">{{$product['productName']}}</span> <br>
                            {{$product['description']}} <br>
                            &#x20B9; {{$product['price']}}
                        </td>

                        <td>
                             @if($product['quantity'] > 0)
                             <span class="text-success">Available</span> <br> <button class="btn btn-sm productCart text-light bg-success" id="product_{{$product['id']}}"><span id="cartText_{{$product['id']}}">Add to cart</span> </button>
                             <div>
                                 <a href="/myCart" class="btn btn-sm text-white bg-warning" style="display: none;" id="checkOut_{{$product['id']}}">Go to cart</a>
                             </div>
                             <div>
                                 <button class="btn removeFromCart btn-sm text-white bg-danger" id="removeCart_{{$product['id']}}" style="display: none;">remove</button>
                             </div>


                             @else
                             <span class="text-danger">Out of stock</span>
                              @endif
                              <input type="hidden" id="productId" name="productId" value="{{$product['id']}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</body>
<script>

    $('.productCart').click(function(){
        var pIdName = $(this).closest('td').find('#productId');
        var pId = pIdName.val();
        addToCart(pId);
    });

    $('.removeFromCart').click(function(){
        var pIdName = $(this).closest('td').find('#productId');
        var pId = pIdName.val();
        removeFromCart(pId);
        $('#product_'+pId).show();
        $('#checkOut_'+pId).hide();
        $('#removeCart_'+pId).hide();
    });

</script>
</html>
