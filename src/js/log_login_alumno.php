<?php
include "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['correo'];
    $password = $_POST['contras'];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM `alumnos` where correo = '" . $email . "' AND contras = '" . $password . "' ";
    $query =  mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['correo'] = $row['correo'];
        header('Location: ../../admin/plataforma.php');
        //exit;
    } else {
        echo "<script> alert('Correo o contraseña incorrectas.'); </script>";
        echo '<a class="btn btn-warning" href="../../admin/login_alumno.php">volver</a>';
    }
}