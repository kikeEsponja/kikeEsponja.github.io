<?php
	session_start();
	if(isset($_SESSION['nombre']) && isset($_SESSION['correo'])){
		include "../src/js/config.php"; 
		$idAlumno = $_SESSION['id'];

        //$correoAlumno = mysqli_real_escape_string($conn, $_SESSION['correo']);
		//$idAlumno = mysqli_real_escape_string($conn, $_SESSION['id']);

        //$chequeoAlumno = "SELECT cupos FROM turnos WHERE id = '$idAlumno'";
        //$resultAlumno = mysqli_query($conn, $chequeoAlumno);

		$query_agendados = "SELECT id, fecha, hora FROM turnos WHERE id_alumno = ?";
		$stmt_agendados = $conn->prepare($query_agendados);
		$stmt_agendados->bind_param("i", $idAlumno);
		$stmt_agendados->execute();
		$result_agendados = $stmt_agendados->get_result();
		$turnos_agendados = $result_agendados->fetch_all(MYSQLI_ASSOC);
		
		$query_disponibles = "SELECT id, fecha, hora, cupos FROM turnos WHERE (id_alumno IS NULL OR id_alumno != ?) AND cupos > 0";
		$stmt_disponibles = $conn->prepare($query_disponibles);
		$stmt_disponibles->bind_param("i", $idAlumno);
		$stmt_disponibles->execute();
		$result_disponibles = $stmt_disponibles->get_result();
		$turnos_disponibles = $result_disponibles->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<meta http-equiv="refresh" content="20"> para refrescar la pagina-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="fortrainevolution.com">
	<meta name="description" content="sistema administrativo">
	<link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
	<link rel="shortcut icon" href="../src/img/logo_azul_wat.svg">	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/admin.css">
    <title>Administración</title>
	<style>
		h3{
			line-height: 2;
		}
        img{
        	width: 5%;
        }
        .fecha{
        	display:none;
        }
        @media(max-width: 420px){
        	img{
            	width:30%;
            }
            .fecha{
        		display:block;
        	}
		}
	</style>
</head>
<body>
    <div class="blue"></div>
	<header>
    	<img src="../src/img/logo_blonco_wat.svg">
    	<hr>
    	<div>
        	<div class="mi-dinero bg-primary">
            	<div>
              		<!--<h3 class="ok" id="SaludoUser-coin"><?php //echo $_SESSION['nombre']; echo ": " . $calificacionesText ?></h3>-->
					<h3 class="ok" id="SaludoUser-coin"><?php echo $_SESSION['nombre'] ?></h3>
					<?php
					if(!empty($turnos_agendados)): ?>
					<ul>
						<?php
						foreach($turnos_agendados as $turno): ?>
							<li><?php echo htmlspecialchars($turno['fecha'] . ' - ' . $turno['hora']); ?></li>
						<?php endforeach; ?>
					</ul>
					<?php else: ?>
						<p>No tienes turnos agendados</p>
					<?php endif; ?>
            	</div>
            	<p><span id="nota"><?php //if(mysqli_num_rows($resultCalifAlumno) > 0){ echo "<h3>notas:</h3>"; while($rowCalif = mysqli_fetch_assoc($resultCalifAlumno)){ echo "<p>Curso: ". $rowCalif['materia'] . " - Nota: " . $rowCalif['calificacion'] . "</p>"; }}else{ echo "<h2>No hay calificaciones aún</h2>";}}else{ echo "<h4>Alumno no encontrado</h4>";} ?></span></p>
        	</div>
        	<div class="loader" id="loader"></div>
    	</div>
	</header>
	<main>
		<div>
        	<div class="botones">
                <button class="btn btn-warning" id="cerrarSes">cerrar sesión</button><br>
            </div>
			<div class="text-light sigonosigo" id="confirma" style="display:none;">
            	<h4 class="bad">Confirmar salida</h4>
                <button class="btn btn-danger" id="si">Sí</button>
                <button class="btn btn-info" id="no">No</button>
			</div>
          	<div>
            	<div class="bg-warning seguirjugando" id="excelente" style="display:none;">Continuemos!</div>
            </div>
		</div>
    	<center>
        	<h2 class="text-light" id="formulario-diario"></h2>
        	<div id="calificaciones" class="text-light">Calificaciones aquí</div>
        	<hr>
			<h2>TURNOS</h2>
			<div class="contenedor-cursos">
				
					<div class="curso html">
						<h3>TURNOS DISPONIBLES</h3>
						<form action="./verificar.php" method="POST">
							<select class="t" id="turno" name="turno" required>
								<option value="">Seleccione</option>
								<?php foreach ($turnos_disponibles as $turno): ?>
                				<option value="<?php echo $turno['id']; ?>">
                    				<?php echo "{$turno['fecha']} - {$turno['hora']} (Cupos disponibles: {$turno['cupos']})"; ?>
                				</option>
            				<?php endforeach; ?>
    						</select>
							<input type="hidden" name="id_alumno" value="<?php echo htmlspecialchars($idAlumno); ?>">
							<button type="submit">Agendar</button>
						</form>
					</div>
			</div>
    	</center>
	</main>
	<script>
        var botonCerrar = document.getElementById("cerrarSes");
        var confText = document.getElementById("confirma");
        var yes = document.getElementById("si");
        var nain = document.getElementById("no");
        var excelente = document.getElementById("excelente");
        botonCerrar.addEventListener("click", function(){
            confText.style.display = "flex";
        });
        yes.addEventListener("click", function(){
            window.location.href = "../index.php";
        });
        no.addEventListener("click", function(){
            excelente.style.display = "block";
            confText.style.display = "none";
            setTimeout(function(){
                excelente.style.display = "none";
            }, 2000);
        });
    	
    	let formDiario = document.getElementById('formulario-diario');
    	formDiario.textContent = 'FORMULARIO DIARIO';
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php
    }else{
        header('location: ./mal.php');
    }
?>