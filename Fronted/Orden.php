<?php
require_once "vistas/parte_superior.php";
?>

<?php
function filterRecord($query)
{
    include("../BD/config.php"); // Configuración de la conexión
    $filter_result = mysqli_query($mysqli, $query);
    if (!$filter_result) {
        die("Error en la consulta: " . mysqli_error($mysqli));
    }
    return $filter_result;
}

// Consulta al procedimiento almacenado para obtener las órdenes de trabajo
$query = "CALL ObtenerOrdenesDeTrabajo()";
$result = filterRecord($query);
?>

<!-- INICIO del contenido principal -->
<div class="container">
    <Center>
        <h1>Órdenes de Trabajo</h1>
    </Center>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" type="button" href="Registration_Orden.php">Nueva Orden</a>
                <br><br>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <?php
                    echo "<table id='example' class='table table-striped table-bordered table-condensed' style='width:100%'>
                        <thead class='text-center'>
                        <tr>
                            <th># Orden</th>
                            <th>Fecha Emisión</th>
                            <th>Fecha Vencimiento</th>
                            <th>Descripción</th>
                            <th>Cliente</th>
                            <th>Ejecutivo</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>";
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Orden_de_Trabajo'] . "</td>";
                            echo "<td>" . $row['Fecha_Emision'] . "</td>";
                            echo "<td>" . $row['Fecha_Vencimiento'] . "</td>";
                            echo "<td>" . $row['Descripcion'] . "</td>";
                            echo "<td>" . $row['Nombre'] . "</td>";
                            echo "<td>" . $row['Nombre_Completo'] . "</td>";
                            echo "<td>";
                            echo "<div class='text-center'>";
                            echo "<div class='btn-group'>";
                            echo "<a type='button' id='btn-editar-popup-user' class='btn btn-light' href='Edit_Orden.php?id=" . $row['ID_Orden_de_Trabajo'] . "'>Editar</a>";
                            echo "<a type='button' class='btn btn-danger btnBorrar' href='../BD/Delete_Orden.php?id=" . $row['ID_Orden_de_Trabajo'] . "'>Borrar</a>";
                            echo "<a type='button' class='btn btn-primary' href='Imprimir_Orden.php?id=" . $row['ID_Orden_de_Trabajo'] . "'>Imprimir</a>";
                            echo "</div></div></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No hay datos disponibles</td></tr>";
                    }

                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "vistas/parte_inferior.php";?>
