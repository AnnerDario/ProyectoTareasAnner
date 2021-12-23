<?php 
echo "Hola, aqui puede registrar una tarea y se mostrara luego:"
?>
<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if ($conexion->connect_error) die ("Fatal error");

    if (isset($_POST['delete']) && isset($_POST['id_tarea']))
    {   
        $id_tarea = get_post($conexion, 'id_tarea');
        $query = "DELETE FROM tareas WHERE id_tarea='$id_tarea'";
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
    }

    if (isset($_POST['id_tarea']) &&
        isset($_POST['titulo']) &&
        isset($_POST['contenido']) &&
        isset($_POST['fechaderegistro']) &&
        isset($_POST['fechadevencimiento']) &&
        isset($_POST['prioridad']) )
    {
        $id_tarea = get_post($conexion, 'id_tarea');
        $titulo = get_post($conexion, 'titulo');
        $contenido = get_post($conexion, 'contenido');
        $fechaderegistro = get_post($conexion, 'fechaderegistro');
        $fechadevencimiento = get_post($conexion, 'fechadevencimiento');
        $prioridad = get_post($conexion, 'prioridad');
        $query = "INSERT INTO tareas VALUE" .
            "('$id_tarea', '$titulo', '$contenido', '$fechaderegistro', '$fechadevencimiento', '$prioridad')";
        $result = $conexion->query($query);
        if (!$result) echo "INSERT falló <br><br>";
    }

    echo <<<_END
    <form action="tdtareas.php" method="post"><pre>
        id o numero de tarea: <input type="text" name="id_tarea" placeholder="Aqui va el numero de la tarea mi king">
        Titulo de la tarea: <input type="text" name="titulo" placeholder="Aqui va el titulo de la tarea mi king">
        Contenido de la tarea: <textarea name="contenido" cols="25" rows="15" maxlength=="200" wrap="type">
        </textarea>
        Fecha de registro de tarea: <input type="datetime" name= "fechaderegistro"  placeholder="0000-00-00 00:00:00">
        Fecha de vencimiento de tarea: <input type="datetime" name= "fechadevencimiento" placeholder="0000-00-00 00:00:00">
        Prioridad de la tarea: <input type="text" name= "prioridad"placeholder="Alta=1, Media=2, baja=3">
             <input type="submit" value="Añadir tarea =)">
    </pre></form>
    _END;

    $query = "SELECT * FROM tareas";
    $result = $conexion->query($query);
    if (!$result) die ("Falló el acceso a la base de datos");

    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; $j++)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        $r2 = htmlspecialchars($row[2]);
        $r3 = htmlspecialchars($row[3]);
        $r4 = htmlspecialchars($row[4]);
        $r5 = htmlspecialchars($row[5]);

        echo <<<_END
        <pre>
        id_tarea $r0
        titulo $r1
        contenido $r2
        fechaderegistro $r3
        fechadevencimiento $r4
        prioridad $r5
        </pre>
          </pre>
        <form action='tdtareas.php' method='post'>
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='id_tarea' value='$r0'>
        <input type='submit' value='Eliminar tarea registrada'></form>
        _END;
    }

    $result->close();
    $conexion->close();

    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
    echo <<<_END
    <form action="pagprincipal.php" method="post"><pre>
        <input type="submit" value="Regresar al lobby o principal =) ">
             <br>
    </pre></form>

    _END;
?>
