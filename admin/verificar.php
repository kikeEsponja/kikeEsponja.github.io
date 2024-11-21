<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../src/js/config.php"; // Conexión a la base de datos

    $id_turno = $_POST['turno'];
    $id_alumno = $_POST['id_alumno'];

    // Validar que el turno existe y tiene cupos disponibles
    $query = "SELECT cupos FROM turnos WHERE id = ? AND cupos > 0";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_turno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $turno = $result->fetch_assoc();

        // Reducir los cupos disponibles y asignar el turno al alumno
        $query_update = "UPDATE turnos SET cupos = cupos - 1, id_alumno = ? WHERE id = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("ii", $id_alumno, $id_turno);

        if ($stmt_update->execute()) {
            echo "Turno agendado con éxito.";
            echo "<a href='./vista.php'>volver</a>";
        } else {
            echo "Error al agendar el turno.";
            echo "<a href='./vista.php'>volver</a>";
        }
    } else {
        echo "El turno seleccionado no está disponible.";
        echo "<a href='./vista.php'>volver</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}