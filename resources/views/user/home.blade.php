@include('user.userHeader')
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center bg-light ">

            <form class="pt-1" action="{{ route('search') }}" method="get" id="searchForm">
                <p>

                    <input type="text" name="searchProduct" id="searchProduct" value="{{ $searchProduct ?? '' }}" placeholder="Search product">

                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                    <button class="btn btn-primary" type="button" onclick="return validator();" >
                        Search
                    </button>
                  </p>

                    <div class="collapse" id="collapseExample">

                        <div class="card card-body">
                            <div class="form-group">
                                <label for="selectCat">Category</label>
                                <select class="form-control bg-white" id="selectCat" name="selectCat">
                                  <option value="0"> Select </option>
                                  <option value="5">Pant</option>
                                  <option value="6">Shirt</option>
                                  <option value="7">Sarees</option>
                                  <option value="8">Dresses</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="selectFor">For</label>
                                <select class="form-control bg-white" id="selectFor" name="selectFor">
                                  <option value="0"> Select </option>
                                  <option value="1">Men</option>
                                  <option value="2">Women</option>
                                  <option value="3">Boys</option>
                                  <option value="4">Girls</option>
                                </select>
                              </div>

                        </div>

                    </div>
                </form>

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

    function validator() {

        if ($('#searchProduct').val() == '' && $('#selectFor').val() == 0 && $('#selectCat').val() == 0) {
            alert(' Please search or select something. ');
            $('.collapse').collapse()
            return false;
        }

        $('#searchForm').submit();
    }

</script>
</html>
