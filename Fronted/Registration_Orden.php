<?php
require_once "../BD/config.php"; 
require_once "vistas/parte_superior.php"; 

$query_clientes = "CALL ObtenerClientesParaOrden()";
$result_clientes = mysqli_query($mysqli, $query_clientes);
$clientes = [];

if ($result_clientes) {
    while ($row = mysqli_fetch_assoc($result_clientes)) {
        $clientes[] = $row;
    }
}

// Procesar resultados pendientes
while (mysqli_next_result($mysqli)) {
    if ($res = mysqli_store_result($mysqli)) {
        mysqli_free_result($res);
    }
}

$query_ejecutivos = "CALL ObtenerEjecutivosParaOrden()";
$result_ejecutivos = mysqli_query($mysqli, $query_ejecutivos);
$ejecutivos = [];

if ($result_ejecutivos) {
    while ($row = mysqli_fetch_assoc($result_ejecutivos)) {
        $ejecutivos[] = $row;
    }
}

// Procesar resultados pendientes
while (mysqli_next_result($mysqli)) {
    if ($res = mysqli_store_result($mysqli)) {
        mysqli_free_result($res);
    }
}
?>

<div class="container">
    <center>
        <h1>Registrar Nueva Orden</h1>
    </center>
    <form action="../BD/Create_Orden.php" method="POST">
        <div class="form-group">
            <label for="ID_Orden_de_Trabajo">ID Orden de Trabajo:</label>
            <input type="text" class="form-control" name="ID_Orden_de_Trabajo" required>
        </div>
        <div class="form-group">
            <label for="Fecha_Emision">Fecha de Emisión:</label>
            <input type="date" class="form-control" name="Fecha_Emision" required>
        </div>
        <div class="form-group">
            <label for="Fecha_Vencimiento">Fecha de Vencimiento:</label>
            <input type="date" class="form-control" name="Fecha_Vencimiento" required>
        </div>
        <div class="form-group">
            <label for="Descripcion">Descripción:</label>
            <textarea class="form-control" name="Descripcion" required></textarea>
        </div>
        <div class="form-group">
            <label for="Codigo_Cliente">Código Cliente:</label>
            <select class="form-control" name="Codigo_Cliente" required>
                <option value="">Seleccione un cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['Documento_Identidad'] ?>">
                        <?= $cliente['Documento_Identidad'] ?> - <?= $cliente['Nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Codigo_Ejecutivo">Código Ejecutivo:</label>
            <select class="form-control" name="Codigo_Ejecutivo" required>
                <option value="">Seleccione un ejecutivo</option>
                <?php foreach ($ejecutivos as $ejecutivo): ?>
                    <option value="<?= $ejecutivo['ID_Ejecutivo_Cuentas'] ?>">
                        <?= $ejecutivo['ID_Ejecutivo_Cuentas'] ?> - <?= $ejecutivo['Nombre_Completo'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Cancelar</button>
        </div>
    </form>
</div>

<?php require_once "vistas/parte_inferior.php"; ?>
