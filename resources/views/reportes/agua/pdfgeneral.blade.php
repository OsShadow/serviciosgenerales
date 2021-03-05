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
<body style="font-family: Arial">
    <div style="margin-left: 50px;">

        <h4>Reporte lecturas del agua</h4>
        <br>

        @foreach ($reportes as $indice => $reporte)

            <table class="table table-bordered" style="width: 600px; ">
                <tbody>
                    <tr style="border: 5px;">
                        <th scope="row" style="width: 100px"> Fecha: </th>
                        <th scope="row" style="width: 100px"> Hora: </th>
                        <th scope="row"> Lectura: </th>
                        <th scope="row"> Cloración: </th>
                    </tr>

                    @foreach ($reporte as $r)
                        <tr>
                            <td>{{ $r->date }} </td>
                            <td>{{ $r->hour }}</td>
                            <td>{{ $r->read }}</td>
                            <td>{{ $r->cloration }}</td>

                        </tr>

                    @endforeach

                </tbody>
                <h5 class="text-right" style="margin-right: 50px">
                    Consumo: {{ $wreports[$indice]->consumption }}
                 </h5>
            </table>

        @endforeach
        <br>


    </div>
</body>

</html>
