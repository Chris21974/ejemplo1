<?php
// Recibir datos de forma segura desde el formulario POST
$tipo_usuario    = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : 'otro';
$cliente         = isset($_POST['cliente']) ? $_POST['cliente'] : '';
$ruc_cliente     = isset($_POST['ruc_cliente']) ? $_POST['ruc_cliente'] : '';
$descripcion     = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$cantidad        = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;
$precio_unitario = isset($_POST['precio_unitario']) ? (float)$_POST['precio_unitario'] : 0.00;

// Variables dinámicas fijas
$nombre_usuario = "Christian Velez"; 
$num_factura    = "FAC-" . date("Y") . "-" . rand(1000, 9999);
$fecha_emision  = date("d/m/Y");

// Lógica de Validación de Roles (Compatible con PHP 5.3)
$usuario_valido = false;
$mensaje_bienvenida = "";
$clase_alerta = "";

if ($tipo_usuario === "admin") {
    $mensaje_bienvenida = "Bienvenido, " . $nombre_usuario . ". Has ingresado como Administrador (Acceso Completo).";
    $clase_alerta = "alert-admin";
    $usuario_valido = true;
} elseif ($tipo_usuario === "usuario") {
    $mensaje_bienvenida = "Bienvenido, " . $nombre_usuario . ". Has ingresado como Usuario Registrado (Acceso Limitado).";
    $clase_alerta = "alert-user";
    $usuario_valido = true;
} elseif ($tipo_usuario === "visitante") {
    $mensaje_bienvenida = "Bienvenido, " . $nombre_usuario . ". Has ingresado como Visitante (Solo Lectura).";
    $clase_alerta = "alert-visitor";
    $usuario_valido = true;
} else {
    $mensaje_bienvenida = "Usuario no reconocido o sin credenciales. Acceso denegado.";
    $clase_alerta = "alert-error";
}

// Cálculos matemáticos de la factura
$total_item = $cantidad * $precio_unitario;
$subtotal   = $total_item;
$iva        = $subtotal * 0.15; // IVA 15%
$total_pagar = $subtotal + $iva;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Procesada</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="panel-tarjeta">
    <div class="alert <?php echo $clase_alerta; ?>">
        <?php echo $mensaje_bienvenida; ?>
    </div>

    <?php if ($usuario_valido): ?>
        <div class="factura-box">
            <div class="factura-header">
                <h3 style="margin: 0; color: #0f172a;">FACTURA COMERCIAL</h3>
                <small style="color: #64748b;">N° <?php echo $num_factura; ?></small>
            </div>
            
            <div class="factura-info">
                <div>
                    <strong>Emisor:</strong><br>
                    TechSolutions S.A.<br>
                    RUC: 1792456789001
                </div>
                <div class="text-right">
                    <strong>Cliente:</strong> <?php echo htmlspecialchars($cliente); ?><br>
                    <strong>RUC:</strong> <?php echo htmlspecialchars($ruc_cliente); ?><br>
                    <strong>Fecha:</strong> <?php echo $fecha_emision; ?>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th class="text-right">Cant.</th>
                        <th class="text-right">P. Unit</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($descripcion); ?></td>
                        <td class="text-right"><?php echo $cantidad; ?></td>
                        <td class="text-right">$<?php echo number_format($precio_unitario, 2); ?></td>
                        <td class="text-right">$<?php echo number_format($total_item, 2); ?></td>
                    </tr>
                    
                    <tr class="totales-row">
                        <td colspan="2"></td>
                        <td class="text-right">Subtotal:</td>
                        <td class="text-right">$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                    <tr class="totales-row">
                        <td colspan="2"></td>
                        <td class="text-right">IVA (15%):</td>
                        <td class="text-right">$<?php echo number_format($iva, 2); ?></td>
                    </tr>
                    <tr class="totales-row total-final">
                        <td colspan="2"></td>
                        <td class="text-right">Total a Pagar:</td>
                        <td class="text-right">$<?php echo number_format($total_pagar, 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    
    <br>
    <a href="index.php" style="color: #2563eb; text-decoration: none; font-weight: bold;">← Crear otra factura</a>
</div>

</body>
</html>