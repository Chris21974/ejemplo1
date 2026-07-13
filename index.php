<?php 
session_start(); 

$datos = isset($_SESSION['datos']) ? $_SESSION['datos'] : array();
$errores = isset($_SESSION['errores']) ? $_SESSION['errores'] : array();
$exito = isset($_SESSION['registro_exitoso']) ? $_SESSION['registro_exitoso'] : false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Membresía de Asociación</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container">

    <?php if ($exito): ?>
        <div class="success-box">
            <h1>¡Registro Exitoso!</h1>
            <p>Tus datos han sido validados y procesados correctamente de manera segura.</p>
            <a href="procesar.php?action=reset" class="btn-volver">Volver a registrar</a>
        </div>

    <?php else: ?>
        <h2>Formulario de Membresía de Asociación</h2>

        <?php if (!empty($errores)): ?>
            <div class="error-box">
                <strong>Por favor, corrige los siguientes campos:</strong>
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="procesar.php" method="POST">
            
            <h3>Información de miembro</h3>

            <span class="label-text">Nombre completo</span>
            <div class="row">
                <div class="col">
                    <input type="text" name="nombre" placeholder="Primer nombre" value="<?php echo htmlspecialchars(isset($datos['nombre']) ? $datos['nombre'] : ''); ?>">
                </div>
                <div class="col">
                    <input type="text" name="apellido" placeholder="Apellido" value="<?php echo htmlspecialchars(isset($datos['apellido']) ? $datos['apellido'] : ''); ?>">
                </div>
            </div>

            <span class="label-text">¿Cuál es tu dirección?</span>
            <div class="input-group">
                <input type="text" name="direccion1" placeholder="Habla a" value="<?php echo htmlspecialchars(isset($datos['direccion1']) ? $datos['direccion1'] : ''); ?>">
            </div>
            <div class="input-group">
                <input type="text" name="direccion2" placeholder="Línea de dirección 2" value="<?php echo htmlspecialchars(isset($datos['direccion2']) ? $datos['direccion2'] : ''); ?>">
            </div>

            <div class="row row-four-cols">
                <div class="col col-city">
                    <input type="text" name="ciudad" placeholder="Ciudad" value="<?php echo htmlspecialchars(isset($datos['ciudad']) ? $datos['ciudad'] : ''); ?>">
                </div>
                <div class="col col-state">
                    <input type="text" name="estado" placeholder="Dirección del estado" value="<?php echo htmlspecialchars(isset($datos['estado']) ? $datos['estado'] : ''); ?>">
                </div>
                <div class="col col-zip">
                    <input type="text" name="codigo_postal" placeholder="Código pos" value="<?php echo htmlspecialchars(isset($datos['codigo_postal']) ? $datos['codigo_postal'] : ''); ?>">
                </div>
                <div class="col col-country">
                    <select name="pais">
                        <option value="">Select a count...</option>
                        <option value="Ecuador" <?php if(isset($datos['pais']) && $datos['pais'] == 'Ecuador') echo 'selected'; ?>>Ecuador</option>
                        <option value="Otro" <?php if(isset($datos['pais']) && $datos['pais'] == 'Otro') echo 'selected'; ?>>Otro</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <span class="label-text">Número de teléfono</span>
                <input type="tel" name="telefono" placeholder="📞 Número de teléfono" value="<?php echo htmlspecialchars(isset($datos['telefono']) ? $datos['telefono'] : ''); ?>">
            </div>

            <div class="input-group">
                <span class="label-text">Dirección de correo electrónico</span>
                <input type="email" name="email" placeholder="✉ Dirección de correo electrónico" value="<?php echo htmlspecialchars(isset($datos['email']) ? $datos['email'] : ''); ?>">
            </div>

            <button type="submit">Enviar Registro</button>
        </form>
    <?php endif; ?>

</div>

</body>
</html>