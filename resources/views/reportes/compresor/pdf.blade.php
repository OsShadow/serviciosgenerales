<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <div style="font-family: 'Trajan Pro'">
        
            <div class="d-inline-block"  style="margin-top: 10px">
                <img src={{ asset('dist/img/udg/udg.png') }} style="height: 130px" alt="UDG">
            </div>
            <div class="d-inline-block" style="margin-top: 10px">
            <p> <span style="font-size: 30px"> Universidad de Guadalajara </span> <br>
                <span style="font-size: 20px">Centro Universitario de los Altos </span> <br>
                <span>Secretaría Administrativa </span> <br>
                <span>Coordinación de Servicios Generales </span>
            </p>
        </div>
    </div>

    <p class="text-center" style="font-family: 'Arial'; font-size: 25px">Reporte de compresor</p>

    <div style="margin-left: 50px;">
        <table class="table table-bordered" style="width: 600px;">
            <tbody>
                <tr>
                    <th scope="row"> Fecha reporte: </th>
                    <td>{{ $compresor->date }}</td>
                </tr>
                <tr>
                    <th scope="row"> Nivel de aceite: </th>
                    <td>{{ $compresor->oil_level }} %</td>
                </tr>
                <tr>
                    <th scope="row"> Temperatura: </th>
                    <td>{{ $compresor->temperature }} °C</td>
                </tr>
                <tr>
                    <th scope="row"> Observaciones: </th>
                    <td>{{ $compresor->observations }}</td>
                </tr>
                <tr>
                    <th scope="row"> ID: </th>
                    <td>{{ $compresor->user_report }}</td>
                </tr>
                <tr>
                    <th scope="row"> Persona que realizó el reporte:
                    </th>
                    <td>{{ $user->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
