<?php
include("../BD/config.php");

$id = $_GET['id'];
$clienteData = [];
$documentoData = [];
$direccionData = [];
$result = null;

// Consulta para obtener los datos del cliente
$queryCliente = "CALL MostrarClientePorID('$id')";
$result = mysqli_query($mysqli, $queryCliente);

if ($result) {
    $clienteData = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

// Procesar resultados pendientes
while (mysqli_next_result($mysqli)) {
    if ($res = mysqli_store_result($mysqli)) {
        mysqli_free_result($res);
    }
}

// Consulta para obtener los datos de la dirección
if (!empty($clienteData['Tipo_Documento'])) {
    $tipo = mysqli_real_escape_string($mysqli, $clienteData['Tipo_Documento']);
    $queryDocumento = "CALL MostrarDocumentoDeCliente('$tipo')";
    $resultDocumento = mysqli_query($mysqli, $queryDocumento);

    if ($resultDocumento) {
        $documentoData = mysqli_fetch_assoc($resultDocumento);
        mysqli_free_result($resultDocumento);
    }

    // Procesar resultados pendientes
    while (mysqli_next_result($mysqli)) {
        if ($res = mysqli_store_result($mysqli)) {
            mysqli_free_result($res);
        }
    }
}

// Consulta para obtener los datos de la dirección
if (!empty($clienteData['Direccion'])) {
    $dic = mysqli_real_escape_string($mysqli, $clienteData['Direccion']);
    $queryDireccion = "CALL MostrarDireccionDeClientePorDireccion('$dic')";
    $resultDireccion = mysqli_query($mysqli, $queryDireccion);

    if ($resultDireccion) {
        $direccionData = mysqli_fetch_assoc($resultDireccion);
        mysqli_free_result($resultDireccion);
    }

    // Procesar resultados pendientes
    while (mysqli_next_result($mysqli)) {
        if ($res = mysqli_store_result($mysqli)) {
            mysqli_free_result($res);
        }
    }
}

?>
<?php require_once "vistas/parte_superior.php"; ?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h1>Modificar Cliente</h1>
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
                                    <form action="../BD/Update_Cliente.php" method="POST">

                                        <!-- Campos del cliente -->
                                        <?php if (!empty($documentoData)): ?>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="Tipo_Documento" value="<?= $clienteData['Tipo_Documento'] ?>" hidden>
                                            </div>
                                            <div class="form-group">
                                                <label for="Numero_Documento" class="col-form-label">Número de documento:</label>
                                                <input type="text" class="form-control" name="Numero_Documento" value="<?= $documentoData['Numero_Documento'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nacionalidad" class="col-form-label">Nacionalidad:</label>
                                                <input type="text" class="form-control" name="Nacionalidad" value="<?= $documentoData['Nacionalidad'] ?>" required>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Campos del cliente -->
                                        <?php if (!empty($clienteData)): ?>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="Documento_Identidad" value="<?= $clienteData['Documento_Identidad'] ?>" hidden>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nombre" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control" name="Nombre" value="<?= $clienteData['Nombre'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nombre_Comercial" class="col-form-label">Nombre Comercial:</label>
                                                <input type="text" class="form-control" name="Nombre_Comercial" value="<?= $clienteData['Nombre_Comercial'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Correo_Electronico" class="col-form-label">Correo Electrónico:</label>
                                                <input type="email" class="form-control" name="Correo_Electronico" value="<?= $clienteData['Correo_Electronico'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Telefono" class="col-form-label">Teléfono:</label>
                                                <input type="text" class="form-control" name="Telefono" value="<?= $clienteData['Telefono'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Direccion" class="col-form-label">Dirección:</label>
                                                <input type="text" class="form-control" name="Direccion" value="<?= $clienteData['Direccion'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Dias_Credito" class="col-form-label">Días de Crédito:</label>
                                                <input type="text" class="form-control" name="Dias_Credito" value="<?= $clienteData['Dias_Credito'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Codigo_Interno" class="col-form-label">Código Interno:</label>
                                                <input type="text" class="form-control" name="Codigo_Interno" value="<?= $clienteData['Codigo_Interno'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Tipo_Cliente" class="col-form-label">Tipo de Cliente:</label>
                                                <input type="text" class="form-control" name="Tipo_Cliente" value="<?= $clienteData['Tipo_Cliente'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Codigo_Barra" class="col-form-label">Código de Barra:</label>
                                                <input type="text" class="form-control" name="Codigo_Barra" value="<?= $clienteData['Codigo_Barra'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Ubigeo" class="col-form-label">Ubigeo:</label>
                                                <input type="text" class="form-control" name="Ubigeo" value="<?= $clienteData['Ubigeo'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Correos_Opcionales" class="col-form-label">Correos Opcionales:</label>
                                                <input type="text" class="form-control" name="Correos_Opcionales" value="<?= $clienteData['Correos_Opcionales'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Estado_Contribuyente" class="col-form-label">Estado del Contribuyente:</label>
                                                <input type="text" class="form-control" name="Estado_Contribuyente" value="<?= $clienteData['Estado_Contribuyente'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Condicion_Contribuyente" class="col-form-label">Condición del Contribuyente:</label>
                                                <input type="text" class="form-control" name="Condicion_Contribuyente" value="<?= $clienteData['Condicion_Contribuyente'] ?>" required>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Campos de la dirección -->
                                        <?php if (!empty($direccionData)): ?>
                                            <div class="form-group">
                                                <label for="Direccion" class="col-form-label">Tipo de Vía:</label>
                                                <input type="text" class="form-control" name="Direccion" value="<?= $direccionData['Direccion'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Tipo_Via" class="col-form-label">Tipo de Vía:</label>
                                                <input type="text" class="form-control" name="Tipo_Via" value="<?= $direccionData['Tipo_Via'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Numero" class="col-form-label">Número:</label>
                                                <input type="text" class="form-control" name="Numero" value="<?= $direccionData['Numero'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Distrito" class="col-form-label">Distrito:</label>
                                                <input type="text" class="form-control" name="Distrito" value="<?= $direccionData['Distrito'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Ciudad" class="col-form-label">Ciudad:</label>
                                                <input type="text" class="form-control" name="Ciudad" value="<?= $direccionData['Ciudad'] ?>" required>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Selector Ejecutivo de Cuentas -->
                                        <?php
                                        $resultEjecutivo = mysqli_query($mysqli, "CALL ObtenerEjecutivos()");
                                        ?>
                                        <div class="form-group">
                                            <label for="ID_Ejecutivo_Cuentas" class="col-form-label">Ejecutivo de Cuentas:</label>
                                            <select id="ID_Ejecutivo_Cuentas" name="ID_Ejecutivo_Cuentas" required>
                                                <?php if ($resultEjecutivo): ?>
                                                    <?php while ($rowEjecutivo = mysqli_fetch_assoc($resultEjecutivo)): ?>
                                                        <option value="<?= $rowEjecutivo['ID_Ejecutivo_Cuentas'] ?>">
                                                            <?= $rowEjecutivo['Nombre_Completo'] ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <option value="">No hay ejecutivos de cuentas disponibles</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- Botones -->
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-light" onclick="history.back()" data-dismiss="modal">Cancelar</a>
                                            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FIN del cont principal-->
    <?php require_once "vistas/parte_inferior.php"; ?>
