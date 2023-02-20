<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/style.css') }}">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/cardvalidation.js') }}"></script>
    <title>Payment Solution</title>
</head>
    <body>
        <section class="header">
 
            <div class="container">
                <div class="brand_logo">
                    <img src="{{ URL::asset('assets/image/clearstartlogo.jpg') }}" class="img-fluid" alt="">
                </div>
    
            </div>
    
        </section>
        @yield('content')
        @yield('scripts')
    </body>

</html>


