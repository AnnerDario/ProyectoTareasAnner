<?php //signup.php
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['nickname']) && isset($_POST['password']))
    {
        $nombre = mysql_entities_fix_string($conexion, $_POST['nombre']);
        $apellido = mysql_entities_fix_string($conexion, $_POST['apellido']);
        $nickname = mysql_entities_fix_string($conexion, $_POST['nickname']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['password']);

        $password = password_hash($pw_temp, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuario
            VALUES('$nombre','$apellido','$nickname', '$password')";

        $result = $conexion->query($query);
        if (!$result) die ("Falló registro");

        echo "Registro exitoso <a href='iniciosesion.php'>Ingresar</a>";
        
    }
    else
    {
        echo <<<_END
        <h1>Regístrate</h1>
        <form action="registrar.php" method="post"><pre>
        Nombre:  <input type="text" name="nombre">
        Apellido:  <input type="text" name="apellido">
        Usuario:  <input type="text" name="nickname">
        Password: <input type="password" name="password">
                 <input type="hidden" name="reg" value="yes">
                 <input type="submit" value="REGISTRAR">
        </form>
        _END;
    }
    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        //if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
      }   
?>