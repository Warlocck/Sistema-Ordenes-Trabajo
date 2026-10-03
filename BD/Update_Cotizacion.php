<?php
require_once "vistas/parte_superior.php";
include("../BD/config.php");

$cotizacion = [
    'Monto' => '',
    'Moneda' => '',
    'Tipo_de_Cambio' => '',
    'Detalles' => '',
    'Fecha_Emision' => '',
    'Tiempo_Validez' => '',
    'Tiempo_Entrega' => '',
    'Direccion_Envio' => ''
];

if (isset($_GET['id'])) {
    $id_cotizacion = $_GET['id'];
}
?>
<?php
include("config.php");

$id_cotizacion = $_POST['id_cotizacion'];
$monto = $_POST['monto'];
$moneda = $_POST['moneda'];
$tipo_cambio = $_POST['tipo_cambio'];
$detalles = $_POST['detalles'];
$fecha_emision = $_POST['fecha_emision'];
$tiempo_validez = $_POST['tiempo_validez'];
$tiempo_entrega = $_POST['tiempo_entrega'];
$direccion_envio = $_POST['direccion_envio'];

// Llamar al procedimiento almacenado para actualizar la cotización
$query = "CALL ActualizarCotizacion(?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($query);
$stmt->bind_param(
    "sdsdssiii", 
    $id_cotizacion, 
    $monto, 
    $moneda, 
    $tipo_cambio, 
    $detalles, 
    $fecha_emision, 
    $tiempo_validez, 
    $tiempo_entrega, 
    $direccion_envio
);

if ($stmt->execute()) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '   icon: "success",';
    echo '   title: "Cotización actualizada",';
    echo '   showConfirmButton: false,';
    echo '   timer: 1300';
    echo '}).then(function(result) {';
    echo 'window.location="../Fronted/Cotizacion.php";';
    echo '});';
    echo '</script>';
} else {
    echo '<script>';
    echo 'Swal.fire({';
    echo '   icon: "error",';
    echo '   title: "Error al actualizar la cotización",';
    echo '   showConfirmButton: false,';
    echo '   timer: 1300';
    echo '}).then(function(result) {';
    echo 'window.location="../Fronted/Cotizacion.php";';
    echo '});';
    echo '</script>';
}

$stmt->close();
?>

<!-- INICIO del contenido principal -->
<div class="container">
    <center>
        <h1>Editar Cotización</h1>
    </center>
    <div class="container">
        <br>
        <form action="" method="POST">
            <div class="modal-body">
                <!-- Campos de edición -->
                <div class="form-group">
                    <label for="Monto">Monto:</label>
                    <input type="number" step="0.01" class="form-control" name="Monto" id="Monto" value="<?= $cotizacion['Monto'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="Moneda">Moneda:</label>
                    <input type="text" class="form-control" name="Moneda" id="Moneda" value="<?= $cotizacion['Moneda'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="Tipo_Cambio">Tipo de Cambio:</label>
                    <input type="number" step="0.01" class="form-control" name="Tipo_Cambio" id="Tipo_Cambio" value="<?= $cotizacion['Tipo_de_Cambio'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="Detalles">Detalles:</label>
                    <textarea class="form-control" name="Detalles" id="Detalles" rows="3" required><?= $cotizacion['Detalles'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="Fecha_Emision">Fecha de Emisión:</label>
                    <input type="date" class="form-control" name="Fecha_Emision" id="Fecha_Emision" value="<?= $cotizacion['Fecha_Emision'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="Tiempo_Validez">Tiempo de Validez (días):</label>
                    <input type="number" class="form-control" name="Tiempo_Validez" id="Tiempo_Validez" value="<?= $cotizacion['Tiempo_Validez'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="Tiempo_Entrega">Tiempo de Entrega (días):</label>
                    <input type="number" class="form-control" name="Tiempo_Entrega" id="Tiempo_Entrega" value="<?= $cotizacion['Tiempo_Entrega'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="Direccion_Envio">Dirección de Envío:</label>
                    <input type="text" class="form-control" name="Direccion_Envio" id="Direccion_Envio" value="<?= $cotizacion['Direccion_Envio'] ?>" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="history.back()">Cancelar</button>
                <button type="submit" class="btn btn-dark">Guardar Cambios</button>
            </div>
        </form>

        <?php
        // Procesamiento de formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $monto = $_POST['Monto'];
            $moneda = $_POST['Moneda'];
            $tipo_cambio = $_POST['Tipo_Cambio'];
            $detalles = $_POST['Detalles'];
            $fecha_emision = $_POST['Fecha_Emision'];
            $tiempo_validez = $_POST['Tiempo_Validez'];
            $tiempo_entrega = $_POST['Tiempo_Entrega'];
            $direccion_envio = $_POST['Direccion_Envio'];

            // Llamar al procedimiento almacenado
            $update_query = "CALL EditarCotizacion(
                '$id_cotizacion',
                $monto,
                '$moneda',
                $tipo_cambio,
                '$detalles',
                '$fecha_emision',
                $tiempo_validez,
                $tiempo_entrega,
                '$direccion_envio'
            )";

            if (mysqli_query($mysqli, $update_query)) {
                echo "<script>alert('Cotización actualizada exitosamente.'); window.location.href='cotizacion.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar la cotización: " . mysqli_error($mysqli) . "');</script>";
            }
        }
        ?>
    </div>
</div>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inferior.php"; ?>