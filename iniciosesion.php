<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");

    if (isset($_POST['nickname'])&&
        isset($_POST['password']))
    {
        $un_temp = mysql_entities_fix_string($conexion, $_POST['nickname']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['password']);
        $query   = "SELECT * FROM usuario WHERE nickname='$un_temp'";
        $result  = $conexion->query($query);
        
        if (!$result) die ("Usuario no encontrado");
        elseif ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();

            //if (password_verify($pw_temp, $row[2])) 
            
                session_start();
                $_SESSION['nombre']=$row[0];
                $_SESSION['apellido']=$row[1];
                echo htmlspecialchars("$row[0] $row[1]:
                    hola $row[0], has ingresado como '$row[0]'");
                die ("<p><a href='pagprincipal.php'>
              Continuar a la pagina de tareas (click)</a></p>");
            
            //else {
                echo "Usuario/password incorrecto <p><a href='registrar.php'>
            Registrarse</a></p>";
            
        }
        else {
          echo "Usuario/password incorrecto <p><a href='registrar.php'>
      Registrarse</a></p>";
      }   
    }
    else
    {
      echo <<<_END
      <h1>Iniciar sesion</h1>
      <form action="iniciosesion.php" method="post"><pre>
      Usuario  <input type="text" name="nickname">
      Password <input type="password" name="password">
               <input type="submit" value="INGRESAR">
      </form>
      _END;
    }

    $conexion->close();

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