<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entregas</title>
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
</style>

<body>
    <div>
        <nav>
            <h1>Schoolmate U.E.G.P. Nº 28 Félix Frías</h1>
        </nav>

        <div>
            <hr>
            <b>Tarea: </b>{{$job->title}} <br><br>
            <b>Inicio:</b> {{$job->start->format('d-m-Y')}} <b> / Fin:</b> {{$job->end->format('d-m-Y')}} <br><br>
            <b>Materia: </b>{{$job->subject->name}} <b> / Profesor: </b>{{$job->subject->teacher->name}} <br><br>
            <hr>
        </div>
        <br>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Entrega</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                @foreach ($entregas as $entrega)
                <tbody>
                    <tr>
                        <td>{{$entrega->student->name}}</td>
                        <td style="text-align: center">{{$entrega->updated_at->format('d-m-Y H:i')}}</td>
                        <td style="text-align: center">{{$entrega->state($entrega->state)}}</td>
                    </tr>
                </tbody>
                @endforeach
                @foreach ($alumnos as $alumno)
                <tbody>
                    <tr>
                        <td>{{$alumno->name}}</td>
                        <td style="text-align: center">S/E</td>
                        <td style="text-align: center">S/E</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <br>
        <footer style="bottom: 0; position: absolute;">
            <hr>
            <p style="text-align: right"><b>Creado:</b> {{now()->format('d-m-Y H:i')}}</p>

        </footer>
    </div>
</body>

</html>