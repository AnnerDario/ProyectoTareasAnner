<?php 
    session_start();

    if (isset($_SESSION['nombre']))
    {
        $nombre = htmlspecialchars($_SESSION['nombre']);
        $apellido = htmlspecialchars($_SESSION['apellido']);

        echo "Bienvenido otra vez $nombre.<br>
               Estas son las opciones que puede elegir: $nombre $apellido.<br>
               <a href=cerrarsesion.php>Cerrar sesion de $nombre (click)</a>";
    }
    else echo "Por favor <a href=iniciosesion.php>Click aqui</a>
                para ingresar";

            echo <<<_END
            <form action="tdtareas.php" method="post"><pre>
                <input type="submit" value="Ver o registrar tareas: ">
                     <br>
            </pre></form>

            _END;
            echo <<<_END
            <form action="tareaspen.php" method="post"><pre>
                <input type="submit" value="Tareas pendientes: ">
            <br>
            </pre></form>

            _END;
            echo <<<_END
            <form action="tareasvenc.php" method="post"><pre>
                <input type="submit" value="Tareas vencidas: ">
            <br>
            </pre></form>

            _END;
            echo <<<_END
            <form action="tareasarchiv.php" method="post"><pre>
                <input type="submit" value="Tareas archivadas: ">
            <br>
            </pre></form>

            _END;
?>
