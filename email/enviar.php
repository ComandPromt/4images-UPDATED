<?php
date_default_timezone_set('Europe/Madrid');
function enviar($para, $asunto, $mensaje, $archivo,$remitente,$tipo){

  switch($tipo){
  
      case 'gmail':
      $seguridad="ssl";
      $host="smtp.gmail.com";
      $puerto=465;
      break;
  
      case 'hotmail':
      $seguridad="tls";
      $host="smtp.live.com";
      $puerto=587;
      break;
  
  }
  
      include_once 'class.phpmailer.php';
      include_once 'class.smtp.php';
  
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
  
      $mail->SMTPSecure = $seguridad;
      $mail->Host = $host;
      $mail->Port = $puerto;
  
      $mail->Username = 'grulargo@gmail.com';
      $mail->Password = 'minions1'; 
  
      $mail->FromName = $remitente;
      $mail->AddAddress($para);
      $mail->Subject = $asunto;
      $mail->Body = $mensaje;
  
      /*  Añadir una imagen incrustada
          $mail->AddEmbeddedImage("rocks.png", "my-attach", "rocks.png"); 
          $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach">'; 
      */

    //  $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
      //$mail->MsgHTML($mensaje);
      $mail->From = $mail->Username;
  $mail->Send();
    
  }

if(isset($_POST['enviar'])){
	print $_POST['mensaje'];
    enviar($_POST['email'], $_POST['asunto'], $_POST['mensaje'], '',"Test","gmail");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Correo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    </head>
    <body>
        <div class="wrap">
           <section id="principal">
                <form id="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="campos">
                        <label>Para:</label>
                        <input type="email" name="email" required><br/><br/>
                    </div>
                    <div class="campos">
                        <label>Asunto:</label>
                        <input type="text" name="asunto"><br/><br/>
                    </div>
                    <div class="campos">
                        <label>Mensaje:</label>
                        <textarea name="mensaje"></textarea><br/><br/>
                    </div>
                    <label>Imagen:</label>
                    <input type="file" name="hugo" id="imagen" />
                    <input id="submit" type="submit" name="enviar" value="Enviar mail">
                </form>
            </section>
        </div>
    </body>
</html>
