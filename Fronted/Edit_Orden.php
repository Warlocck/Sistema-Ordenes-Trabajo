<?php
include("../BD/config.php");
$id = $_GET['id']; 

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

<?php
require_once "vistas/parte_superior.php";
?>

<div class="container">
    <center>
        <h1>Modificar Orden de Trabajo</h1>
    </center>
    <div class="container">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <div aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <a type="button" class="close" data-dismiss="modal" onclick="history.back()" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                    <form action="../BD/Update_Orden.php" method="POST">
                                        <?php
                                        $result = mysqli_query($mysqli, "CALL MostrarOrdenPorID('$id')");
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <div class='form-group'>
                                                <label for='ID_Orden_de_Trabajo' class='col-form-label'>ID Orden de Trabajo:</label>
                                                <input type='text' class='form-control' name='ID_Orden_de_Trabajo' value='<?= $row['ID_Orden_de_Trabajo'] ?>' readonly>
                                            </div>
                                            <div class='form-group'>
                                                <label for='Fecha_Emision' class='col-form-label'>Fecha de Emisión:</label>
                                                <input type='date' class='form-control' name='Fecha_Emision' value='<?= $row['Fecha_Emision'] ?>' required>
                                            </div>
                                            <div class='form-group'>
                                                <label for='Fecha_Vencimiento' class='col-form-label'>Fecha de Vencimiento:</label>
                                                <input type='date' class='form-control' name='Fecha_Vencimiento' value='<?= $row['Fecha_Vencimiento'] ?>' required>
                                            </div>
                                            <div class='form-group'>
                                                <label for='Descripcion' class='col-form-label'>Descripción:</label>
                                                <textarea class='form-control' name='Descripcion' rows='3' required><?= $row['Descripcion'] ?></textarea>
                                            </div>
                                            <div class='form-group'>
                                                <label for='Codigo_Cliente' class='col-form-label'>Código Cliente:</label>
                                                <select class='form-control' name='Codigo_Cliente' required>
                                                    <option value=''>Seleccione un cliente</option>
                                                    <?php foreach ($clientes as $cliente) : ?>
                                                        <option value="<?= $cliente['Documento_Identidad'] ?>" <?= $cliente['Documento_Identidad'] == $row['Codigo_Cliente'] ? 'selected' : '' ?>>
                                                            <?= $cliente['Documento_Identidad'] ?> - <?= $cliente['Nombre'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='Codigo_Ejecutivo' class='col-form-label'>Código Ejecutivo:</label>
                                                <select class='form-control' name='Codigo_Ejecutivo' required>
                                                    <option value=''>Seleccione un ejecutivo</option>
                                                    <?php foreach ($ejecutivos as $ejecutivo) : ?>
                                                        <option value="<?= $ejecutivo['ID_Ejecutivo_Cuentas'] ?>" <?= $ejecutivo['ID_Ejecutivo_Cuentas'] == $row['Codigo_Ejecutivo'] ? 'selected' : '' ?>>
                                                            <?= $ejecutivo['ID_Ejecutivo_Cuentas'] ?> - <?= $ejecutivo['Nombre_Completo'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class='modal-footer'>
                                                <a type='button' class='btn btn-light' onclick='history.back()' data-dismiss='modal'>Cancelar</a>
                                                <button type='submit' id='btnGuardar' class='btn btn-dark'>Guardar</button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "vistas/parte_inferior.php"; ?>
