<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Incluir conexión a la base de datos
    include '../src/js/config.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

    // Capturar datos del formulario
    $fecha = $_POST['fecha'] ?? null;
    $hora = $_POST['hora'] ?? null;
    $cupos = $_POST['cupos'] ?? null;

    // Validar los datos
    if (!$fecha || !$hora || !$cupos || !is_numeric($cupos) || $cupos <= 0) {
        echo "Por favor, completa todos los campos correctamente.";
        echo '<a href="./admin.php">Volver</a>';
        exit;
    }

    try {
        // Preparar la consulta para evitar duplicados en la misma fecha y hora
        $stmt = $conn->prepare("SELECT COUNT(*) AS existe FROM turnos WHERE fecha = ? AND hora = ?");
        $stmt->bind_param("ss", $fecha, $hora);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['existe'] == 0) {
            // Insertar el nuevo turno
            $stmt = $conn->prepare("INSERT INTO turnos (fecha, hora, cupos) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $fecha, $hora, $cupos);
            if ($stmt->execute()) {
                echo "Turno registrado con éxito.";
                echo '<a href="./admin.php">Volver</a>';
            } else {
                throw new Exception("Error al insertar el turno: " . $stmt->error);
            }
        } else {
            echo "Ya existe un turno en esa fecha y hora.";
            echo '<a href="./admin.php">Volver</a>';
        }
    } catch (Exception $e) {
        // Manejar errores
        echo "Ocurrió un error: " . $e->getMessage();
    } finally {
        // Cerrar conexión
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    echo "Acceso no permitido.";
    echo '<a href="./admin.php">Volver</a>';
}