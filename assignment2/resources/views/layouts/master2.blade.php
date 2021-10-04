<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>@yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
  
    <style>
      .container {
        max-width: 960px;
      }

      /*
      * Custom translucent site header
      */

      .site-header {
        background-color: rgba(0, 0, 0, .85);
        -webkit-backdrop-filter: saturate(180%) blur(20px);
        backdrop-filter: saturate(180%) blur(20px);
      }
      .site-header a {
        color: #8e8e8e;
        transition: color .15s ease-in-out;
      }
      .site-header a:hover {
        color: #fff;
        text-decoration: none;
      }

      /*
      * Dummy devices (replace them with your own or something else entirely!)
      */

      .product-device {
        position: absolute;
        right: 10%;
        bottom: -30%;
        width: 300px;
        height: 540px;
        background-color: #333;
        border-radius: 21px;
        transform: rotate(30deg);
      }

      .product-device::before {
        position: absolute;
        top: 10%;
        right: 10px;
        bottom: 10%;
        left: 10px;
        content: "";
        background-color: rgba(255, 255, 255, .1);
        border-radius: 5px;
      }

      .product-device-2 {
        top: -25%;
        right: auto;
        bottom: 0;
        left: 5%;
        background-color: #e5e5e5;
      }


      /*
      * Extra utilities
      */

      .flex-equal > * {
        flex: 1;
      }
      @media (min-width: 768px) {
        .flex-md-equal > * {
          flex: 1;
        }
      }

      input[type="text"] {
        padding: 8px;
        font-size: 14px;
        border-radius: 9px;
        width: 237px;
      }

      input[type="submit"] {
        padding: .5em 1em;
        border-radius: 6px;
        background-color: rgb(109, 103, 103);
        color: #fff;
        font-family: 'Lato', sans-serif;
        font-size: .8em;
        text-align: center;
      }

      #submit {
        width: 480px;
      }

      #submit1 {
        width: 200px;
        height: 37px;
      }

      label {
        width: 240px;
        display: inline-block;
        text-align: left;
      }

      textarea {
        padding: .5em;
        min-height: 8em;
        min-width: 237px;
        font-size: 14px;
        border: solid 2px;
        border-radius: 9px;
      }

      select {
        padding: .5em;
        min-width: 480px;
        font-size: 14px;
        border-radius: 9px;
        cursor: pointer;
        text-align: center;
      }

      select:hover {
        outline: none;
        border: 1px solid #bbbbbb;
      }

      form {
        border-radius: 9px;
        width: 700px;
        text-align: center;
        display: inline-block;
      }

      #deleteitem {
        width: 237px;
      }
      #deletereview {
        width: 80px;
      }

      #logout {
        width: 100px;
      }

      body {
        text-align: center;
      }

      h1 {
        font-family: Arial, "Times New Roman";
        font-size: 22px;
        font-weight: 370;
        text-align: center;
      }

      a {
        text-align: center;
      }

      table, th, td {
          border: 1.5px solid black;
          text-align: center;
          margin-left: auto;
          margin-right: auto;
          padding: 5px;
        }
    </style>

  </head>




  <body>
    
<header class="site-header sticky-top py-1">
  <nav class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2" href="{{ url("/") }}" aria-label="Product">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
    </a>
    <a class="py-2 d-none d-md-inline-block" href="{{ url("/") }}">Home</a>
    @auth
      <a class="py-2 d-none d-md-inline-block" href="{{ url("user") }}">My profile</a>
      <a class="py-2 d-none d-md-inline-block" href="{{ url("product/create") }}">Create</a>
      <a class="py-2 d-none d-md-inline-block" href="{{ url("recommend/products") }}">Product recommendation</a>
      <a class="py-2 d-none d-md-inline-block" href="{{ url("recommend/users") }}">User recommendation</a>
      <a class="py-2 d-none d-md-inline-block" href="{{ url("documentation") }}">Documentation</a>
      <a class="py-2 d-none d-md-inline-block" href="{{ url("user") }}">{{Auth::user()->name}}
      @if ( Auth::user()->role == 'moderator')
        (Moderator)
      @else
        (Member)
      @endif
      </a>
    @endauth

    @guest
      <a class="py-2 d-none d-md-inline-block" href="{{route('login')}}">Log in</a>
      <a class="py-2 d-none d-md-inline-block" href="{{route('register')}}">Register</a>
    @endguest


  </nav>
</header>

<main>
  <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
      @yield('headline')
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  </div>
</main>

<body>
  @yield('content')
</body>

<footer class="container py-5">
  <div class="row">
    <div class="col-6 col-md">
      <h5>Features</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary" href="{{ url("/") }}">Homepage</a></li>
        <li><a class="link-secondary" href="{{ url("user") }}">My profile</a></li>
        <li><a class="link-secondary" href="{{ url("product/create") }}">Create a product</a></li>
        <li><a class="link-secondary" href="{{ url("recommend/products") }}">Recommend products</a></li>
        <li><a class="link-secondary" href="{{ url("recommend/users") }}">Recommend users</a></li>
        <li><a class="link-secondary" href="{{ url("documentation") }}">Documentation</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Resources</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary" href="https://my.griffith.edu.au/">Griffith University</a></li>
        <li><a class="link-secondary" href="https://www.w3schools.com/css/css_table_align.asp">w3schools</a></li>
        <li><a class="link-secondary" href="https://www.php.net/">PHP</a></li>
        <li><a class="link-secondary" href="https://laravel.com/">Laravel</a></li>
        <li><a class="link-secondary" href="https://laravel.com/docs/8.x/blade">Blade</a></li>
        <li><a class="link-secondary" href="{{ url("documentation") }}">Documentation</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Contact</h5>
      <ul class="list-unstyled text-small">
        <li>quanghuy.nguyen2@griffithuni.edu.au</li>
        <li>+61 4 5636 2613</li>
      </ul>
    </div>

    <div class="col-6 col-md">
      <h5>Login information</h5>
      <ul class="list-unstyled text-small">

        @auth
          <li style="text-align: center; color: black;">User name: {{Auth::user()->name}}</li>
          <li>User type: 
          @if ( Auth::user()->role == 'moderator')
            Moderator
          @else
            Member
          @endif
          </li>

          <form id="logout" method="POST" style="text-align: center;" action="{{url('/logout')}}">
            {{csrf_field()}}
            <input type="submit" value="Logout">
          </form>

        @else
        @endauth

        @guest
          <a href="{{route('login')}}">Log in</a>
          <a href="{{route('register')}}">Register</a>
        @endguest
      </ul>
    </div>
  </div>
</footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>      
  </body>
</html>
