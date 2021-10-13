<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{url('frontend/css/profile.css'))">
  <link rel="stylesheet" href="{{url('frontend/css/all.css'))">
  <link href="{{url('frontend/css/bootstrap.min.css'))" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="{{url('frontend/js/all.js'))"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
  <title>Profile</title>
</head>

<body>
  <div class="container">
    <div class="main-body">

    @include('frontend.partial.header')
   
    @yield('content')


    </div>
</body>

</html>