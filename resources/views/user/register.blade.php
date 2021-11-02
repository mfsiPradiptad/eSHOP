<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('storage/documents/css/style.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    </head>
    <body>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100 d-flex ">
              <div class="row justify-content-center align-items-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="card text-black h-100" style="border-radius: 25px;">
                    <div class="card-body d-flex">
                      <div class="row justify-content-center align-items-center">
                        <div class="col-md-6 col-sm-8 col-xs-8 order-2 order-lg-1 ">

                          <p class="text-center h2 font-weight-bold text-primary">Sign up</p>

                          <form action="/signup" method="post">

                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" autocomplete="off">
                              </div>

                            <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" >
                            </div>

                            <div class="form-group">
                              <label for="password">Password:</label>
                              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" autocomplete="off">
                            </div>

                            <button class="btn btn-primary" onclick="validator();">Sign up</button>
                            <input type="hidden" name="role" value="7">

                          </form>
                          <div class="form-group">
                            <a href="/login">Already have an account.</a>
                          </div>




                        </div>
                        <div class="col-md-6 col-sm-4 col-xs-4 d-flex align-items-center order-1 order-lg-2 d-none d-xl-block">

                          <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </body>
    <script>

        function validator(){

               if($('#name').val() == ''){
                   alert("Please enter your name.");
                   return false;
               }

               if($('#email').val() == ''){
                   alert("Please enter your email");
                   return false;
               }

               if($('#password').val().length <8){
                   alert("Password should be Minimum 8 character.");
                   return false;
               }

               $('#form').submit();

            }
             @php

                if ($msg) {

                    @endphp

                    alert('@php echo $msg; @endphp');

                    @php
                }

            @endphp

    </script>
</html>
