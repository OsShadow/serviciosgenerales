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

<body style="font-family: Arial" >

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

<p class="text-center" style="font-family: 'Arial'; font-size: 25px">Reporte de Ticket</p>


    <div style="margin-left: 50px;">
        

        <table class="table table-bordered" style="width: 600px; ">
            <tbody>
                <tr style="border: 5px;" >
                    <th scope="row" style="width: 80px"> Fecha de creación: </th>
                    <th scope="row"> Estado Ticket: </th>
                    <th scope="row"> Asignado a: </th>
                    <th scope="row"> Descripción: </th>
                    <th scope="row" style="width: 80px"> Fecha límite: </th>
                    <th scope="row" > Hora límite: </th>
                </tr>
                    <tr>
                        <td>{{ $treport->date }} </td>
                        <td>{{ $treport->type }}</td>
                        <td>{{ $treport->employer }}</td>
                        <td>{{ $treport->ticket_report }}</td>
                        <td>{{ $treport->date_finish }}</td>
                        <td>{{ $treport->hour_finish }}</td>
                    </tr>

            </tbody>
        </table>
        <br>
    </div>
</body>

</html>
