@include('admin.header')
<div class="container">

    <p class="text-center h2 font-weight-bold text-primary">{{$data[0]['submit']}} Product</p>
    <div class="row d-flex justify-content-center align-items-center" >
        <div class="card" style="width:80%;">
            <div class="card-body">
                <form action="/uploadProduct" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="pName">Product Name</label>
                        <input type="text" class="form-control form-text" name="pName" id="pName" placeholder="Van T-Shirt" value="{{$data[0]['productName']}}">

                    </div>
                    <div class="form-group">
                        <label for="pDesc">Product Description</label>
                        <input type="text" class="form-control form-text" name="pDesc" id="pDescz" placeholder="Description" value="{{$data[0]['description']}}">
                    </div>
                    <div class="form-group">
                        <label for="selectCat">Category</label>
                        <select class="form-control bg-white" id="selectCat" name="selectCat">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="selectFor">For</label>
                        <select class="form-control bg-white" id="selectFor" name="selectFor">
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="pPrice">Price (&#8377;)</label>
                        <input type="number" class="form-control" name="pPrice" id="pPrice" placeholder="100" value="{{$data[0]['price']}}">
                    </div>
                    <div class="form-group">
                        <label for="pQuantity">Quantity</label>
                        <input type="number" class="form-control" name="pQuantity" id="pQuantity" placeholder="100" value="{{$data[0]['quantity']}}">
                    </div>
                    <div class="form-group">
                        <label for="pImage">Image</label>
                        <input type="file" class="form-control" name="pImage" id="pImage" placeholder="100" accept=".jpg, .jpeg, .png" value="{{$data[0]['image']}}">

                            @if($data[0]['image']!='')


                                <div>
                                    <img src="{{asset('storage/documents/product/' . $data[0]['image']) }}" alt="image" height="100px" width="100px">
                                </div>

                            @endif
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info" onclick="return validator();">{{$data[0]['submit']}}</button>
                        <a class="btn btn-danger" href="/productList">Cancel</a>
                    </div>
                    <input type="hidden" name="id" value="{{$data[0]['id']}}">
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    fillAnxure(1, 'selectCat', {{ $data[0]['intCategory'] }});
    fillAnxure(2, 'selectFor', {{ $data[0]['intFor'] }} );

    @php
            if($msg){
                @endphp
                alert('@php echo $msg; @endphp');
                @php
            }
    @endphp
        function validator(){
            if(!$('#pImage').val()!=''){
                alert('Please upload image');
                return false;
            }
            $('#form').submit();
        }
</script>
</html>

