<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/pageable@latest/dist/pageable.min.css">
    <link rel="stylesheet" href="vista.css">
    <title>Alertas Tempranas</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <style>
        body {
            background: #40ec40;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #1c4733, #176334);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #46e4c9, #8eb9ab);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

    </style>
    @yield('css')
</head>

<body>

    <div id="container">
        <div data-anchor="Page 1" class="">
            <div class="row align-content-center h-100 px-5">
                <div class="col-md-8 col-md-offset-2">
                    <img src="img/patfa-1.png" alt=""> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <a class="btn btn-primary pull-right" style="text-align: right;width:220px" href="{{ route('login') }}"> <center>Ingresar</center></a>
                </div>
            </div>
        </div>

        @php
            $i=1;
        @endphp
        @foreach ($contenidos as $contenido)
        @php
            $i++;
        @endphp
            <div data-anchor="Page {{ $i }}" class="{{ $contenido['color'] }}">
                <div class="row align-content-center h-100 px-5">
                    <div class="{{$contenido['color-texto']}} ">
                        <p>{{ $contenido['titulo'] }} </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    </script>
    <script src="https://unpkg.com/pageable@latest/dist/pageable.min.js"></script>
    <script>
        new Pageable("#container");
    </script>

</body>

</html>
