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
            <td>{{ $trash->date }}</td>
          </tr>
          <tr>
            <th scope="row"> Nivel de aceite: </th>
            <td>{{ $area->label }}</td>
          </tr>
          <tr>
            <th scope="row"> Temperatura: </th>
            <td>{{ $trash->quantity }}</td>
          </tr>
          <tr>
            <th scope="row"> Usuario id: </th>
            <td>{{ $trash->user_report }}</td>
          </tr>
        </tbody>
      </table>
    </div>
</body>
</html>