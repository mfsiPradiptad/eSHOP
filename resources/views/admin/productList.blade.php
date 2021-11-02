@include('admin.header')
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Products</title>


</head>
<body>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <table class="table table-striped table-borderd" id="myTable">
            <thead class="thead-light">
              <tr>
                <th scope="col">Sl#</th>
                <th scope="col">Image</th>
                <th scope="col">Brand Name/ Description</th>
                <th scope="col">Price/ Quantity</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>
                @php

                    $count=1;
                @endphp
                @foreach ( $data as $product)
                   <tr>
                    <td>{{$count++}} </td>
                    <td><img src="{{asset('storage/documents/product/'.$product['image']) }}" alt="image" height="70px" width="100px"></td>
                    <td>{{$product['productName']}} <br> {{$product['description']}} </td>
                    <td>&#8377; {{$product['price']}} <br> {{$product['quantity']}} pcs</td>
                    <td><a href="/addProduct/{{$product['id']}}">Edit</a> </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
</body>
<script>
    $('#myTable').dataTable({
        "bLengthChange": false,
        "searching": false
     });
</script>
</html>
