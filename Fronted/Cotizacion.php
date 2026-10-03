<?php
require_once "vistas/parte_superior.php"
?>
<?php
$query = "CALL ObtenerCotizaciones()";
$result = filterRecord($query);

function filterRecord($query)
{
    include("../BD/config.php");
    $filter_result = mysqli_query($mysqli, $query);
    return $filter_result;

}

?>
<!--INICIO del cont principal-->
<div class="container">
    <Center>
        <h1>Cotizaciones</h1>
    </Center>
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" type="button" href="Registration_Cotizacion.php">Nuevo</a>
                <br>
                <br>
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
                    <th>ID</th>
                    <th>Nombre del Cliente</th>
                    <th>DNI Cliente</th>
                    <th>Nombre del Ejecutivo</th>
                    <th>Fecha de Emision</th>
                    <th>Direccion de Envio</th>
                    </tr></thead>";

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Cotizacion'] . "</td>";
                            echo "<td>" . $row['Cliente_Nombre'] . "</td>";
                            echo "<td>" . $row['Cliente_Documento'] . "</td>";
                            echo "<td>" . $row['Ejecutivo_Nombre'] . "</td>";
                            echo "<td>" . $row['Fecha_Emision'] . "</td>";
                            echo "<td>" . $row['Direccion_Envio'] . "</td>";
                            echo "<td >";
                            echo "<div class='text-center'>";
                            echo "<div class='btn-group'>";
                            echo "<a  type='button' id='btn-editar-popup-user'class='btn btn-light'  href='Edit_Cotizacion.php?id=" . $row['ID_Cotizacion'] . "'>Editar</a>";
                            echo "<a  type='button' class='btn btn-danger btnEliminar' href='Cotizacion.php?eliminar=" . $row['ID_Cotizacion'] . "'>Eliminar</a>";
                            echo "</div></div></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// Manejo del formulario de eliminación
if (isset($_GET['eliminar'])) {
    $id_cotizacion = $_GET['eliminar'];
    echo "
    <div class='container mt-4'>
        <div class='alert alert-danger'>
            <h4>Confirmar Eliminación</h4>
            <p>¿Está seguro que desea eliminar la cotización con ID <strong>$id_cotizacion</strong>?</p>
            <form method='POST' action='../BD/Delete_Cotizacion.php'>
                <input type='hidden' name='ID_Cotizacion' value='$id_cotizacion'>
                <button type='submit' class='btn btn-danger'>Eliminar</button>
                <a href='Cotizacion.php' class='btn btn-secondary'>Cancelar</a>
            </form>
        </div>
    </div>";
}
?>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>