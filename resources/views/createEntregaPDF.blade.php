<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }

    table {
        border-collapse: collapse;
    }

    td {
        padding: 4px
    }

    table,
    tr,
    th,
    td {
        border: 1px solid;
        width: 100%;
    }

    nav {
        text-align: center;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <div>
        @foreach ($auxFotos ?? [] as $item)
        <nav>
            <h1 class="relative">Schoolmate U.E.G.P. Nº 28 Félix Frías</h1>
            <b>Alumno: </b> {{$auxNombre}} - <b>Tarea: </b> {{$job->title}}
            <hr>
        </nav>
        <img class="relative" style="margin-top: 80px" src="{{public_path($item)}}" alt="" srcset="">
        @if (!$loop->last)
        <div class="page-break"></div>
        @endif
        @endforeach
    </div>
</body>

</html>