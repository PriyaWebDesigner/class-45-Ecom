<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce</title>
</head>
<body>
    <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce Website</title>
	@include('frontend.includes.style')
</head>
<body>
	@include('frontend.includes.header')


	<main>
        @yield('content')

    </main>


	@include('frontend.includes.footer')

    @include('frontend.includes.script')
</body>
</html>
    
</body>
</html>