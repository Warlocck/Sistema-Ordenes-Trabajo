<?php
require_once "vistas/parte_superior.php";
include("../BD/config.php");

// Obtener datos de clientes
$query = "CALL ObtenerDatosCotizacion()";
$result = mysqli_query($mysqli, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
mysqli_next_result($mysqli); // Liberar resultados para evitar conflictos

if ($result) {

    // Conjunto 2: Ejecutivos
    $ejecutivos = [];
    if ($res = mysqli_store_result($mysqli)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $ejecutivos[] = $row;
        }
        mysqli_free_result($res);
    }

    // Avanzar al siguiente conjunto de resultados
    mysqli_next_result($mysqli);

    // Conjunto 3: Órdenes de Trabajo
    $ordenes = [];
    if ($res = mysqli_store_result($mysqli)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $ordenes[] = $row;
        }
        mysqli_free_result($res);
    }
}
?>

<!-- INICIO del contenido principal -->
<div class="container">
    <center>
        <h1>Registrar una nueva Cotización</h1>
    </center>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <div aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Cotización</h5>
                                    <a type="button" class="close" data-dismiss="modal" onclick="history.back()" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <!-- Campo para seleccionar cliente -->
                                        <div class="form-group">
                                            <label for="Cliente">Seleccione Cliente:</label>
                                            <select class="form-control" name="Cliente" id="Cliente" required>
                                                <option value="">Seleccione un cliente</option>
                                                <?php
                                                foreach ($data as $row) {
                                                    echo "<option value='{$row['Cliente_ID']}'>{$row['Cliente_Nombre']} - {$row['Cliente_Correo']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- Campo para seleccionar ejecutivo -->
                                        <div class="form-group">
                                            <label for="Ejecutivo">Seleccione Ejecutivo:</label>
                                            <select class="form-control" name="Ejecutivo" id="Ejecutivo" required>
                                                <option value="">Seleccione un ejecutivo</option>
                                                <?php foreach ($ejecutivos as $ejecutivo): ?>
                                                    <option value="<?= $ejecutivo['Ejecutivo_ID'] ?>">
                                                        <?= $ejecutivo['Ejecutivo_Nombre'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- Campo para seleccionar orden de trabajo -->
                                        <div class="form-group">
                                            <label for="Codigo_Orden">Seleccione Orden de Trabajo:</label>
                                            <select class="form-control" name="Codigo_Orden" id="Codigo_Orden" required>
                                                <option value="">Seleccione una orden</option>
                                                <?php foreach ($ordenes as $orden): ?>
                                                    <option value="<?= $orden['Orden_ID'] ?>">
                                                        <?= $orden['Orden_Descripcion'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- Otros campos -->
                                        <div class="form-group">
                                            <label for="Monto">Monto:</label>
                                            <input type="number" step="0.01" class="form-control" name="Monto" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Moneda">Moneda:</label>
                                            <input type="text" class="form-control" name="Moneda" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tipo_Cambio">Tipo de Cambio:</label>
                                            <input type="number" step="0.01" class="form-control" name="Tipo_Cambio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Detalles">Detalles:</label>
                                            <textarea class="form-control" name="Detalles" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="Fecha_Emision">Fecha de Emisión:</label>
                                            <input type="date" class="form-control" name="Fecha_Emision" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tiempo_Validez">Tiempo de Validez (días):</label>
                                            <input type="number" class="form-control" name="Tiempo_Validez" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Tiempo_Entrega">Tiempo de Entrega (días):</label>
                                            <input type="number" class="form-control" name="Tiempo_Entrega" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Direccion_Envio">Dirección de Envío:</label>
                                            <input type="text" class="form-control" name="Direccion_Envio" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" onclick="history.back()">Cancelar</button>
                                        <button type="submit" class="btn btn-dark">Guardar</button>
                                    </div>
                                </form>

                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $cliente = $_POST['Cliente'];
                                    $ejecutivo = $_POST['Ejecutivo'];  // Capturamos el Ejecutivo
                                    $monto = $_POST['Monto'];
                                    $moneda = $_POST['Moneda'];
                                    $tipo_cambio = $_POST['Tipo_Cambio'];
                                    $detalles = $_POST['Detalles'];
                                    $fecha_emision = $_POST['Fecha_Emision'];
                                    $tiempo_validez = $_POST['Tiempo_Validez'];
                                    $tiempo_entrega = $_POST['Tiempo_Entrega'];
                                    $direccion_envio = $_POST['Direccion_Envio'];
                                    $codigo_orden = $_POST['Codigo_Orden'];  // Capturamos el Codigo_Orden

                                    // Liberar cualquier resultado restante antes de la inserción
                                    while (mysqli_next_result($mysqli)) {
                                        if ($res = mysqli_store_result($mysqli)) {
                                            mysqli_free_result($res);
                                        }
                                    }

                                    // Llamar al procedimiento almacenado
                                    $insert_query = "CALL InsertarCotizacion(
                                        $monto,
                                        '$moneda',
                                        $tipo_cambio,
                                        '$detalles',
                                        '$fecha_emision',
                                        $tiempo_validez,
                                        $tiempo_entrega,
                                        '$direccion_envio',
                                        '0001', -- Número de cuenta
                                        '$cliente',
                                        '$codigo_orden',  -- Enviamos Codigo_Orden al procedimiento
                                        '$ejecutivo'  -- Enviamos el Documento_Identidad del Ejecutivo al procedimiento
                                    )";

                                    if (mysqli_query($mysqli, $insert_query)) {
                                        echo "<script>alert('Cotización registrada exitosamente.'); window.location.href='Cotizacion.php';</script>";
                                    } else {
                                        echo "<script>alert('Error al registrar la cotización: " . mysqli_error($mysqli) . "');</script>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIN del contenido principal -->
<?php require_once "vistas/parte_inferior.php"; ?>