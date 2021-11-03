@include('user.userHeader')
<div class="container">
    {{-- <div class="row d-flex justify-content-center align-items-center">

    </div> --}}
    <div class="row d-flex justify-content-center align-items-center">

        <form action="/checkOut" method="post" id="form">
            @csrf
            <p class="text-center h1 font-weight-bold text-primary">Delivery Details</p>
            <div class="form-gorup">
                <label class="font-weight-bold" for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name">
            </div>
            <div class="form-gorup">
                <label class="font-weight-bold" for="mobile">Mobile</label>
                <input class="form-control" type="text" name="mobile" id="mobile" minlength="10" maxlength="10">
            </div>
            <div class="form-gorup">
                <label class="font-weight-bold" for="address">Address</label>
                <textarea class="form-control" name="address" id="address" cols="30" rows="2"></textarea>
            </div>
            <div class="form-gorup">
                <label for=""></label>
                <button class="form-control btn btn-warning" onclick="return validator()">Place order</button>
            </div>
            <input type="hidden" name="totalAmount" value="{{$amount}}">
        </form>
    </div>
</div>
<script>

    $("#mobile").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
   });

   function validator() {

       if ($('#name').val() == ''){
           alert('Name can not be empty.');
           return false;
       }

       if ($('#mobile').val() == ''){
           alert('Mobile number can not be empty');
           return false;
       }

       if ($('#mobile').val().length > 10 || $('#mobile').val().length < 10){
           alert('Mobile number should be 10 digit');
           return false;
       }

       if ($('#address').val() == ''){
           alert('Address can not be empty.');
           return false;
       }

       $('#form').submit();

   }

</script>
