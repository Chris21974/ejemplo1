<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Facturas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="panel-tarjeta">
    <h2>Crear Nueva Factura</h2>
    <p>Ingresa los datos para procesar el documento comercial:</p>

    <form action="procesar.php" method="POST">
        <div class="form-group">
            <label for="tipo_usuario">Rol de Usuario:</label>
            <select name="tipo_usuario" id="tipo_usuario" required>
                <option value="admin">Administrador (Christian Velez)</option>
                <option value="usuario">Usuario Registrado</option>
                <option value="visitante">Visitante</option>
                <option value="otro">Usuario Desconocido</option>
            </select>
        </div>

        <div class="form-group">
            <label for="cliente">Nombre del Cliente (Solo letras y espacios):</label>
            <input type="text" name="cliente" id="cliente" pattern="[A-Za-aciónéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required placeholder="Ej. Distribuidora Alfa S.A.">
        </div>

        <div class="form-group">
            <label for="ruc_cliente">RUC del Cliente (Solo 13 números):</label>
            <input type="text" name="ruc_cliente" id="ruc_cliente" pattern="\d{13}" maxlength="13" title="El RUC debe tener exactamente 13 números" required placeholder="Ej. 0991234567001">
        </div>

        <hr>
        <h3>Ítem de la Factura</h3>

        <div class="form-group">
            <label for="descripcion">Descripción del Servicio / Producto:</label>
            <input type="text" name="descripcion" id="descripcion" required placeholder="Ej. Desarrollo de software corporativo">
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad (Solo números enteros):</label>
            <input type="number" name="cantidad" id="cantidad" min="1" step="1" required placeholder="Ej. 1">
        </div>

        <div class="form-group">
            <label for="precio_unitario">Precio Unitario (Número decimal):</label>
            <input type="number" name="precio_unitario" id="precio_unitario" min="0.01" step="0.01" required placeholder="Ej. 1200.00">
        </div>

        <button type="submit" class="btn-enviar">Generar Factura</button>
    </form>
</div>

</body>
</html>