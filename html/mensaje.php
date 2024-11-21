<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Enrique Alejandro Gregorio Barreto Cortez">
    <meta name="description" content="portafolio">
    <link rel="shortcut icon" href="/img/logoparami2.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.7.0/hint.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Finger Paint" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/estilos.css" type="text/css">
    <title>Portafolio</title>
  	<style>
    	h2{
      		color: #000;
    	}
  	</style>
</head>
<body>

    <section>
        <center>
            <div>
                <h1>Estado del mensaje</h1>
                <p>Mensaje enviado</p>
                <button type="button" onclick="goBack()" class="btn btn-warning">Volver</button>
            </div>
        </center>
    </section>

    <div style="width: 100%; background: #eee; padding: 5%;"></div>
          <?php
            function validarTelefono($telefono){
              $patron = "/^\d{2}-\d{4}-\d{4}$/";
              if(preg_match($patron, $telefono)){
                return true;
              }else{
                return false;
              }
            }
            
          if($_SERVER["REQUEST_METHOD"] === "POST"){
            $mensaje = $_POST["mensaje"];
            $nombre = $_POST["nombre"];
			//$apellido = $_POST["apellido"];
            //$empresa = $_POST["empresa"];
			$tel = $_POST["telefono"];
            $correo = $_POST["correo"];
            //$pais = $_POST["pais"];
            $destinatario = "element3999@gmail.com";
            //$destinatario2 = "edgarcortez300@gmail.com";
            //$destinatario3 = "contact@fortrainevolution.com";
            //$destinatario2 = "mariaj.silvestre.sant@gmail.com";
            //$destinatario3 = "silva.campos.angie@gmail.com";
            $asunto = "Nuevo mensaje desde el formulario";
            $cabeceras = "From: contact@fortrainevolution.com";
            
            $cuerpo = 	"Mensaje: " . $mensaje . "\n" .
          				"Correo: " . $correo . "\n" .
          				"Nombre: " . $nombre . "\n" .
          				//"Apellido: " . $apellido . "\n" .
          				//"Empresa: " . $empresa . "\n" .
          				"Teléfono: " . $tel . "\n";
          				//"País: " . $pais;
            
            if(validarTelefono($tel)){
              mail($destinatario, $asunto, $cuerpo, $cabeceras);
              //mail($destinatario2, $asunto, $cuerpo, $cabeceras, $email);
              //mail($destinatario3, $asunto, $cuerpo, $cabeceras, $email);
              //mail($destinatario4, $asunto, $cuerpo, $cabeceras, $email);
              
              $respuestaAutomatica = "
<html>
<head>
    <title>Respuesta Automática</title>
    <style>
        body{
            font-family: Helvetica, sans-serif;
            background: rgba(141, 19, 242, 0.5);
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container{
            background: #03022c;
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(to bottom, #8d13f280, #03022c);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 2px solid black;
            border-radius: 6px;
        }
        .title{
            color: #ff0;
        }
        .message{
            color: #fff;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class=\"container\">
        <h1 class=\"title\">Gracias por su consulta!</h1> 
        <p class=\"message\">Estamos interesados en atender su solicitud. ¿Le gustaría programar una llamada para discutir sus necesidades en detalle?</p>
        <p class=\"message\">Thank you for your inquiry! We are interested in addressing your request. Would you like to schedule a call to discuss your needs in detail?</p>
        <p class=\"message\">Vielen Dank für Ihre Anfrage! Wir sind daran interessiert, Ihr Anliegen zu bearbeiten. Möchten Sie einen Anruf vereinbaren, um Ihre Bedürfnisse im Detail zu besprechen?</p>
        <p class=\"message\">Спасибо за ваш запрос! Мы заинтересованы в рассмотрении вашего запроса. Хотели бы вы назначить звонок, чтобы обсудить ваши потребности подробно?</p>
    </div>
</body>
</html>";
              
				// Cabeceras para correo HTML
				$cabeceras_respuesta = "MIME-Version: 1.0" . "\r\n";
				$cabeceras_respuesta .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$cabeceras_respuesta .= "From: contact@fortrainevolution.com";

				mail($correo, $asunto, $respuestaAutomatica, $cabeceras_respuesta);

				echo "<h2>Gracias por su consulta. Mensaje enviado con éxito</h2>";
			}else{
				echo "<h3>formato de teléfono inválido</h3>";
          	}
          }else{
            echo "<p>no se recibió mensaje</p>";
          }
          ?>

    <!--<script src="../js/index.js"></script>-->
    <script>
      	function goBack(){
    		window.history.back();
		}
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>