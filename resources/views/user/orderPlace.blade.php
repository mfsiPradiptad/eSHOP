@include('user.userHeader')

<div class="container">
    <div class="row">
       <div class="col-md-6 mx-auto mt-5">
          <div class="payment">
             <div class="payment_header">
                <div class="check">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    @if ($data['error'] == 0)
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    @else
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    @endif
                </svg>
                </div>
             </div>
             <div class="content">
                <h1>{{$data['msg']}}</h1>
                <p>Order no. <span>{{$data['uniqueId']}}</span></p>
                <a href="/home">Go to Home</a>
             </div>

          </div>
       </div>
    </div>
 </div>
<script>
    setTimeout(() => {
        window.location.href ='/home';
    }, 1000);
</script>
