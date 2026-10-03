<?php 
require_once "vistas/parte_superior.php"; 

include("../BD/config.php");  
if (isset($_POST['reporte'])) {
    $reporte = $_POST['reporte'];

    switch ($reporte) {
        case "Reporte1":
            $query = "CALL Reporte1()"; 
            break;

        case "Reporte2":
            if (isset($_POST['cliente_id']) && !empty($_POST['cliente_id'])) {
                $codigo_cliente = $_POST['cliente_id'];

                $stmt = $mysqli->prepare("CALL Reporte2(?)");
                $stmt->bind_param("s", $codigo_cliente);
                $stmt->execute();


                $result = $stmt->get_result();
            } else {
                $mostrar_formulario = true;
            }
            break;

        case "Reporte3":
            $query = "CALL Reporte3()"; 
            break;

        case "Reporte4":
            $query = "CALL Reporte4()"; 
            break;

        case "Reporte5":
            $query = "CALL Reporte5()"; 
            break;

        case "Reporte6":
            if (isset($_POST['cliente_id']) && !empty($_POST['cliente_id'])) {
                $codigo_cliente = $_POST['cliente_id'];

                $stmt = $mysqli->prepare("CALL Reporte6(?)");
                $stmt->bind_param("s", $codigo_cliente);
                $stmt->execute();

                // Obtener los resultados
                $result = $stmt->get_result();
            } else {
                $mostrar_formulario = true;
            }
            break;

        case "Reporte7":
            $query = "CALL Reporte7()"; 
            break;

        case "Reporte8":
            $query = "CALL Reporte8()"; 
            break;

        case "Reporte9":
            $query = "CALL Reporte9()"; 
            break;

        case "Reporte10":
            $query = "CALL Reporte10()"; 
             break;

        default:
            $query = null;
            break;
    }

    if (isset($query)) {
        $result = ejecutarReporte($query);
    }
}

function ejecutarReporte($query)
{
    include("../BD/config.php"); 
    return mysqli_query($mysqli, $query);
}
?>

<div class="container">
    <center>
        <h1>Reportes</h1>
    </center>
    
    <?php if (!isset($mostrar_formulario)) { ?>
        <div class="row justify-content-center">
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte1">Ventas por Mes y Año</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte2">Ventas por Cliente</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte3">Cotizaciones Activas</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte4">Oportunidades Abiertas de Venta</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte5">Órdenes de Trabajo por Cliente</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte6">Historial de Cotizaciones</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte7">Ventas No Pagadas</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte8">Oportunidades Ganadas y Perdidas por Mes</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte9">Productos Más Vendidos</button>
                </form>
            </div>
            <div class="col-lg-2">
                <form method="post">
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte10">Reuniones Realizadas</button>
                </form>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($mostrar_formulario)) { ?>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="post">
                    <div class="form-group">
                        <label for="cliente_id">Seleccione un Cliente</label>
                        <select class="form-control" name="cliente_id" required>
                            <option value="">Seleccione un cliente</option>
                            <?php
                            // Consultar clientes disponibles
                            $clientes_query = "CALL ObtenerClientes()"; 
                            $clientes_result = mysqli_query($mysqli, $clientes_query);
                            while ($cliente = mysqli_fetch_assoc($clientes_result)) {
                                echo "<option value='{$cliente['Documento_Identidad']}'>{$cliente['Nombre_Comercial']} ({$cliente['Documento_Identidad']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="reporte" value="Reporte6">Generar Reporte</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<?php if (isset($result) && mysqli_num_rows($result) > 0) { ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">

                            <?php if ($reporte == "Reporte10") { ?>
                                <tr>
                                    <th>ID Cliente</th>
                                    <th>Nombre del Cliente</th>
                                    <th>ID Acta</th>
                                    <th>Proyecto Reunion</th>
                                    <th>Fecha Reunion </th>
                                    <th>Acciones Planificadas</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte9") { ?>
                                <tr>
                                    <th>Descripción del Producto</th>
                                    <th>Cantidad de Ventas</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte8") { ?>
                                <tr>
                                    <th>Mes</th>
                                    <th>Oportunidades Ganadas</th>
                                    <th>Oportunidades Perdidas</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte7") { ?>
                                <tr>
                                    <th>ID Orden de Trabajo</th>
                                    <th>Fecha Emisión</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Descripción</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte6") { ?>
                                <tr>
                                    <th>ID Cotización</th>
                                    <th>Cabecera</th>
                                    <th>Monto</th>
                                    <th>Moneda</th>
                                    <th>Detalles</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte5") { ?>
                                <tr>
                                    <th>ID Cliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>ID Orden de Trabajo</th>
                                    <th>Fecha Emisión</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Descripción</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte4") { ?>
                                <tr>
                                    <th>Vendedor</th>
                                    <th>Oportunidades</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte3") { ?>
                                <tr>
                                    <th>ID Cotización</th>
                                    <th>Cabecera</th>
                                    <th>Monto</th>
                                    <th>Moneda</th>
                                    <th>Detalles</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte2") { ?>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Total Ventas</th>
                                </tr>
                            <?php } elseif ($reporte == "Reporte1") { ?>
                                <tr>
                                    <th>Año</th>
                                    <th>Mes</th>
                                    <th>Total Ventas</th>
                                </tr>
                            <?php } ?>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr class="text-center">
                                    <?php if ($reporte == "Reporte10") { ?>
                                        <td><?php echo $row['ID_Cliente']; ?></td>
                                        <td><?php echo $row['Nombre_Cliente']; ?></td>
                                        <td><?php echo $row['ID_Acta']; ?></td>
                                        <td><?php echo $row['Proyecto_Reunion']; ?></td>
                                        <td><?php echo $row['Fecha_Reunion']; ?></td>
                                        <td><?php echo $row['Acciones_Planificadas']; ?></td>
                                    <?php } elseif ($reporte == "Reporte9") { ?>
                                        <td><?php echo $row['Descripcion']; ?></td>
                                        <td><?php echo $row['Ventas']; ?></td>   
                                    <?php } elseif ($reporte == "Reporte8") { ?>
                                        <td><?php echo $row['Mes']; ?></td>
                                        <td><?php echo $row['Ganadas']; ?></td>
                                        <td><?php echo $row['Perdidas']; ?></td>
                                    <?php } elseif ($reporte == "Reporte7") { ?>
                                        <td><?php echo $row['ID_Orden_de_Trabajo']; ?></td>
                                        <td><?php echo $row['Fecha_Emision']; ?></td>
                                        <td><?php echo $row['Fecha_Vencimiento']; ?></td>
                                        <td><?php echo $row['Descripcion']; ?></td>
                                    <?php } elseif ($reporte == "Reporte6") { ?>
                                        <td><?php echo $row['ID_Cotizacion']; ?></td>
                                        <td><?php echo $row['Cabecera']; ?></td>
                                        <td><?php echo $row['Monto']; ?></td>
                                        <td><?php echo $row['Moneda']; ?></td>
                                        <td><?php echo $row['Detalles']; ?></td>
                                    <?php } elseif ($reporte == "Reporte5") { ?>
                                        <td><?php echo $row['ID_Cliente']; ?></td>
                                        <td><?php echo $row['Nombre_Cliente']; ?></td>
                                        <td><?php echo $row['ID_Orden_de_Trabajo']; ?></td>
                                        <td><?php echo $row['Fecha_Emision']; ?></td>
                                        <td><?php echo $row['Fecha_Vencimiento']; ?></td>
                                        <td><?php echo $row['Descripcion']; ?></td>
                                    <?php } elseif ($reporte == "Reporte4") { ?>
                                        <td><?php echo $row['Nombre_Completo']; ?></td>
                                        <td><?php echo $row['Oportunidades_Abiertas']; ?></td>
                                    <?php } elseif ($reporte == "Reporte3") { ?>
                                        <td><?php echo $row['ID_Cotizacion']; ?></td>
                                        <td><?php echo $row['Cabecera']; ?></td>
                                        <td><?php echo $row['Monto']; ?></td>
                                        <td><?php echo $row['Moneda']; ?></td>
                                        <td><?php echo $row['Detalles']; ?></td>
                                    <?php } elseif ($reporte == "Reporte2") { ?>
                                        <td><?php echo $row['Cliente']; ?></td>
                                        <td><?php echo $row['TotalVentas']; ?></td>
                                    <?php } elseif ($reporte == "Reporte1") { ?>
                                        <td><?php echo $row['Año']; ?></td>
                                        <td><?php echo $row['Mes']; ?></td>
                                        <td><?php echo $row['Total_Ventas']; ?></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php require_once "vistas/parte_inferior.php"; ?>