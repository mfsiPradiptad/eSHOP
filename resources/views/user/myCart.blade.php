@include('user.userHeader')
<div class="container pb-3">
    <div class="row d-flex justify-content-center align-items-center">
        @if (count($data) > 0)
            <table class="table table-striped" id="myTable">
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach ($data  as $product)
                    <tr class="table-primary">
                        <td><img src="{{asset('storage/documents/product/'.$product['image']) }}" alt="image" height="100px" width="100px"></td>
                        <td>
                            <span class="text-primary font-weight-bold">{{$product['productName']}}</span> <br>
                            <span class="text-primary font-weight-bold">{{$product['description']}} </span><br>
                            <span class="text-primary font-weight-bold"> &#x20B9; {{$product['price']}}</span>
                        </td>

                        <td>
                             @if($product['quantity'] > 0)
                             <span class="text-success">Available</span> <br>
                             <div class="form-group">
                               <label for="quantity_{{$product['id']}}">Quantity</label>
                               <select class="form-control form-control-sm orderQuantity" name="quantity_{{$product['id']}}" id="quantity_{{$product['id']}}">
                                 <option value="1" @if ($product['intQuantity'] == 1) { selected } @endif>1</option>
                                 <option value="2" @if ($product['intQuantity'] == 2) { selected } @endif>2</option>
                               </select>
                             </div>
                             <button class="btn removeFromCart btn-sm text-white bg-danger" id="removeCart_{{$product['id']}}">remove</button>
                             @else
                             <span class="text-danger">Out of stock</span>
                              @endif
                              <input type="hidden" id="productId" name="productId" value="{{$product['id']}}">
                        </td>
                    </tr>
                    @php $totalAmount += $product['intQuantity'] * $product['price']; @endphp
                    @endforeach
                    <tr><td colspan="2"><span class="text-primary h3">Total Order Value</span> </td>
                        <td><span class="text-primary h4">&#x20B9; {{$totalAmount}}</span></td>
                        <input type="hidden" name="totalAmount" value="{{$totalAmount}}">
                    </tr>
                </tbody>
            </table>
            <div><a href="/checkOut/{{Crypt::encryptString($totalAmount)}}" class="btn btn-lg text-white bg-warning" id="checkOut_{{$product['id']}}">Check Out</a></div>

        @else
            <p class="text-center h2 font-weight-bold text-primary col-sm-12">Nothing in cart.</p>
            <div>
                <a href="/home" class="btn btn-lg text-white bg-success col-sm-12">Go back</a>
            </div>
        @endif
    </div>
</div>
<script>

    $('.removeFromCart').click(function() {
        var pIdName = $(this).closest('td').find('#productId');
        var pId = pIdName.val();
        removeFromCart(pId);
        var rowCount = $('#myTable tr').length;
        window.location.href = '/myCart'

    });

    $('.orderQuantity').on('change', function() {
        var quantity = this.value;
        var pIdName = $(this).closest('td').find('#productId');
        var pId = pIdName.val();
        updateCart(pId, quantity);
        window.location.href = '/myCart';
    });

</script>
