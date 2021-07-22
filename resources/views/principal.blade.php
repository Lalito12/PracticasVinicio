<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Principal</title>
    <link rel="stylesheet" href="https://cdnj.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <style>
        body{
            margin-left: 100px;
            margin-right: 100px;
            margin-top: 150px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>PRACTICAS GARCIA TURIN</h1>
    <table class="table table-striped table-inverse mt-3 responsive">

        <thead class="thead-inverse">
            <tr>
                <th>PRACTICAS DWI</th>
                <th>VISITAR</th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td>DATA TABLE</td>
                    <td><a href="{{route('index')}}" class="btn btn-success">REVISION</a></td>
                    
                </tr>
                <tr>
                    <td>PRODUCTOS</td>
                    <td><a href="{{route('productos')}}" class="btn btn-danger">CARRITO</a></td>
                </tr>
                <tr>
                    <td>LECTOR QR</td>
                    <td><a href="{{route('qrcode')}}" class="btn btn-dark">CODIGO QR</a></td>
                </tr>
                <tr>
                    <td>ESCANER</td>
                    <td><a href="{{url('escanerqr')}}" class="btn btn-warning">ESCANER</a></td>
                </tr>
            </tbody>
    </table>
</body>
</html>