<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div style="margin-left: 50px;">
    <table class="table table-bordered" style="width: 600px;">
        <tbody>
          <tr>
            <th scope="row"> Fecha reporte: </th>
            <td>{{ $wreport->date }}</td>
          </tr>
          <tr>
            <th scope="row"> Hora de inicio: </th>
            <td>{{ $wreport->start_hour }}</td>
          </tr>
          <tr>
            <th scope="row"> Hora de fin: </th>
            <td>{{ $wreport->final_hour }}</td>
          </tr>
          <tr>
            <th scope="row"> Lectura inicial: </th>
            <td>{{ $wreport->initial_read }}</td>
          </tr>
          <tr>
            <th scope="row"> Lectura final: </th>
            <td>{{ $wreport->final_read }}</td>
          </tr>
          <tr>
            <th scope="row"> Cloración:
            </th>
            <td>{{ $wreport->cloration }}</td>
          </tr>
          <tr>
            <th scope="row"> Consumo:
            </th>
            <td>{{ $wreport->consumption }}</td>
          </tr>
          <tr>
            <th scope="row"> Consumo total:
            </th>
            <td>{{ $wreport->consumption_total }}</td>
          </tr>
          <tr>
            <th scope="row"> Observaciones:
            </th>
            <td>{{ $wreport->Observations }}</td>
          </tr>
          <tr>
            <th scope="row"> Id reportador:
            </th>
            <td>{{ $wreport->user_report }}</td>
          </tr>
        </tbody>
      </table>
    </div>
</body>
</html>