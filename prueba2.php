<?php
	session_start();
	if(isset($_SESSION['nombre']) && isset($_SESSION['correo'])){
		include "../src/js/config.php"; 
		$idAlumno = $_SESSION['id'];
		$query = "SELECT id, fecha, hora, cupos FROM turnos WHERE id_alumno IS NULL OR id_alumno != ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $idAlumno);
		$stmt->execute();
		$result = $stmt->get_result();
		$turnos_agendados = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
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
</html>
<?php
    }else{
        header('location: ./mal.php');
    }
?>