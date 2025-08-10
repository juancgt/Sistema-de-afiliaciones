<html>
    <head>
        <title>
        Correo
        </title>
    </head>
    <body>
        <p>{{$actividad->actividad}}</p>
        <p><strong>Fecha Inicio : </strong>{{$actividad->inicio}}</p>
        <p><strong>Hasta : </strong>{{$actividad->fin}}</p>
        {{print($actividad->descripcion)}}
        <p>Para mayor informacion entre al siguiente enlace</p>
        <a href="http://localhost:8000/detalle_actividad/{{$actividad->id}}">localhost:8000/detalle_actividad/{{$actividad->id}}</a>
    </body>
</html>