<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('storage/documents/css/style.css')}}">
    <script src="{{asset('storage/documents/js/loadJs.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<style>

</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <a class="navbar-brand" href="/home">eShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link text-white" href="myOrders">My Order</a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link text-white" href="/myCart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Cart <span id="cart"></span></a>
                  </li>

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{auth()->user()->name}}
                      </a>
                      <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                          <a class="nav-link btn btn-danger" href="/logout">logout</a>
                      </div>
                  </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                @csrf
              <input class="form-control mr-sm-2" type="text" placeholder="Search product" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0 text-white btn-success" type="submit">Search </button>
            </form>
        </div>
    </nav>





