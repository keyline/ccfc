<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CCFC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
<style>
.brand-maintain {
    margin: 0 auto;
    text-align: center;
}
</style>

<div class="brand-maintain">
    <div class="brand_logo">
        <img class="img-fluid" src="{{URL::to('/img/email-logo.png')}}" alt="" />         
        {{-- <img class="img-fluid" src="{{asset('img/logo.png') }}" alt="" title="Home"> --}}
        <h2>New CCFC website coming soon!</h2>
    </div>
</div>

{{-- <div style="margin: 0 auto; display:table;"><a href="{{ url()->current() }}"><img class="img-fluid" src="{{URL::to('/img/email-logo.png')}}" alt="" /></a></div>
<div style="font-weight: 600; font-size:20px; text-align: center; font-family:Arial, Helvetica, sans-serif;">New CCFC website coming soon!</div> --}}
</body>
</html>