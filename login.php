<?php 
    //Include the connection to mysql database file php
    include_once ('connection_db.php');

    $connection = db_connect();

    //Star a new session
    session_start();

    //Get and error flag
    $error = 0;

    //When user press the submit button
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //user name and password sent from form
        
        $myusername = mysqli_real_escape_string($connection, $_POST['username']);
        $mypassword = mysqli_real_escape_string($connection, $_POST['password']);

        //Fecth the user on the database
        $sql = "SELECT id_admin FROM administrador WHERE nick = '$myusername' AND password = '$mypassword'";

        $result = mysqli_query($connection,$sql);
        //Execute the query
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //$active = $row['active'];

        $count = mysqli_num_rows($result);

        // If the result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
          $_SESSION['login_user'] = $myusername;
          header("location: administrador.php");
        } else {
          $error = 1;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Login</title>

        <link rel="stylesheet" type="text/css" href="styles/estilo_login.css">
    </head>
    <body>

        <h2>Sistema Administrador de la página personal de Víctor Saborío H</h2>

        <p>Para poder iniciar con el sistema, es necesario iniciar sesión, por favor introduzca el correo electrónico y la contraseña.</p>
        <div align="center">
            <div class="cuadro" align="center">
                <div class="avatar">
                </div> <br>
                <form action="" method="post">
                  <label for="email">Nombre de Usuario</label>
                  <input type="text" id="username" name="username" placeholder="Correo electrónico">
                  <label for="password">Contraseña</label>
                  <input type="password" id="password" name="password" placeholder="Contraseña">
                  <input type="submit" value="Iniciar Sesión">
                </form>
                <br><a href="#">¿Has olvida la contraseña?</a>
            </div>
        </div>
        <footer>
            &copy; Copyright - Víctor Saborío H<br>
            Instituto Tecnológico de Costa Rica 2016
        </footer>    
    </body>
</html>