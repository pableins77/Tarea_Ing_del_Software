<?php
$alert = '';

session_start();

if(!empty($_SESSION['active'])){
    header('location: sistemas/');
}else{
    if(!empty($_POST)){
        if(empty($_POST['usuario']) || empty($_POST['clave'])){
			$alert = 'Ingrese su USUARIO y su CLAVE';
		}else{
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conection, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conection, $_POST['clave']));
            $query = mysqli_query($conection, "SELECT
                                                rolusuario.id_usuario,
                                                usuario.nombre,
                                                usuario.correo,
                                                usuario.usuario,
                                                usuario.estatus,
                                                rolusuario.id_rol,
                                                rol.rol
                                                FROM
                                                rolusuario
                                                INNER JOIN rol ON rolusuario.id_rol = rol.idrol
                                                INNER JOIN usuario ON rolusuario.id_usuario = usuario.idusuario WHERE usuario= '$user' AND clave = '$pass' AND estatus='1'");
            mysqli_close($conection);
            $result = mysqli_num_rows($query);

            if($result > 0){           
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['idusuario'];
				        $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['email']  = $data['correo'];
                $_SESSION['user']   = $data['usuario'];
                $_SESSION['estatus']   = $data['estatus'];
                $_SESSION['rol']    = $data['rol'];
                header('location: sistemas/');
            }else{
                $alert = '¡ ------------------ ATENCIÓN-------------------- !
                USUARIO Y / O CONTRASEÑA INCORRECTOS';
                 session_destroy();
            }
        }
    }
}

?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Tarea 2 Seguridad de la Informacion</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- LOGIN -->
    <link href="floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" action="" method="POST">
      <div class="text-center mb-4">
        <img class="mb-4" src="https://www.brainrock.in/img/login-icon.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">LOGIN</h1>
      </div>
      <div class="form-label-group">
        <input type="text" id="inputEmail" class="form-control" placeholder="Usuario" name="usuario" required autofocus autocomplete="off">
        <label for="inputEmail">Usuario</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="clave" required>
        <label for="inputPassword">Contraseña</label>   
      </div>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?>
       
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <html>
     <!DOCTYPE html>

  <!-- Código para la validación Recaptcha -->
  <head>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="?" method="POST">
      <div class="g-recaptcha" data-sitekey="6LfrCfUZAAAAAHsc4HraND-CI9kUSqiMrD0rxlqA" data-callback=enableBtn></div>
      <br/>
               <button class="btn btn-lg btn-primary btn-block" type="submit" id="button1">INGRESAR</button>
    </form>
  </body>
  <!------------------------------------------------------------------------------------------------- -->
</html>
    </form>
    <p class="mt-5 mb-3 text-center">&copy; pajarrin5@utpl.edu.ec</p>
    </html>
<script>
  document.getElementById("button1").disabled = true;
  function enableBtn(){
    document.getElementById("button1").disabled = false;
  }

</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </div></div>
  </body>
  
  
  
