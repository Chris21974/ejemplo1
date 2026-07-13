<?php

session_start();

$errores = array(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre         = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido       = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $direccion1     = isset($_POST['direccion1']) ? trim($_POST['direccion1']) : '';
    $direccion2     = isset($_POST['direccion2']) ? trim($_POST['direccion2']) : '';
    $ciudad         = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
    $estado         = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $codigo_postal  = isset($_POST['codigo_postal']) ? trim($_POST['codigo_postal']) : '';
    $pais           = isset($_POST['pais']) ? trim($_POST['pais']) : '';
    $telefono       = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $email          = isset($_POST['email']) ? trim($_POST['email']) : '';

   
    if (empty($nombre) || empty($apellido)) {
        $errores[] = "El nombre y el apellido son obligatorios.";
    }
    if (empty($direccion1)) {
        $errores[] = "La dirección principal es obligatoria.";
    }
    if (empty($ciudad) || empty($estado) || empty($codigo_postal) || empty($pais)) {
        $errores[] = "Por favor, completa todos los campos de ubicación.";
    }
    if (empty($telefono)) {
        $errores[] = "El número de teléfono es obligatorio.";
    }
    if (empty($email)) {
        $errores[] = "La dirección de correo electrónico es obligatoria.";
    }

   
    if (!empty($nombre) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        $errores[] = "En el campo 'Primer nombre' solo se permiten letras y espacios.";
    }
    if (!empty($apellido) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
        $errores[] = "En el campo 'Apellido' solo se permiten letras y espacios.";
    }

   
    if (!empty($telefono)) {
        if (!preg_match("/^[0-9]+$/", $telefono)) {
            $errores[] = "El teléfono debe contener únicamente números.";
        } elseif (strlen($telefono) !== 10) {
            $errores[] = "El número de teléfono debe tener exactamente 10 dígitos.";
        }
    }

   
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del correo electrónico no es válido.";
    }

  
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        $_SESSION['datos'] = $_POST; 
        header("Location: index.php");
        exit();
    } else {
        if (isset($_SESSION['errores'])) unset($_SESSION['errores']);
        if (isset($_SESSION['datos'])) unset($_SESSION['datos']);
        $_SESSION['registro_exitoso'] = true;
        header("Location: index.php");
        exit();
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'reset') {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>