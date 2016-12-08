<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="style.css">
    <!-- La linea de arriba es para importar estilos CSS a nuestro formulario -->
    <title>Formulario de contacto</title>
</head>
<body>
<section class="formulario">

    <form action="#" method="post">
        <label for="tramiteProceso">Tramites en Proceso:</label>
        <input id="tramiteProceso" type="text" name="tramiteProceso" placeholder="0" required="" />
        <label for="tramiteAbandonados">Tramite Abandonados:</label>
        <input id="tramiteAbandonados" type="text" name="tramiteAbandonados" placeholder="0" required="" />
        <label for="tramiteConcluidos">Tramite Concluidos:</label>
        <<input id="tramiteConcluidos" type="text" name="tramiteConcluidos" placeholder="0" required="" />
        <input id="submit" type="submit" name="submit" value="Enviar" />
    </form>
</section>
</body>
</html>