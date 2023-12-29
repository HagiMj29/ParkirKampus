<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | {{$listtitle}}</title>

    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">

    <link href="{{asset('css/sidebars.css')}}" rel="stylesheet">
</head>
<body>
    <main class="d-flex flex-nowrap container-fluid scrollarea ">
    <td>
        @include('layouts.main')
    </td>
    <td>
    <div class="container-fluid">
        @yield('container')
    </div>
</td>
    </main>
</body>
</html>