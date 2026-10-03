<?php
require_once "vistas/parte_superior.php";

// Llama al procedimiento almacenado y obtiene los resultados
$query = "CALL ObtenerEjecutivos()";
$result = filterRecord($query);

// Función para realizar la consulta en la base de datos
function filterRecord($query)
{
    include("../BD/config.php"); // Asegúrate de que el archivo config.php está correctamente configurado
    $filter_result = mysqli_query($mysqli, $query);
    if (!$filter_result) {
        die("Error en la consulta: " . mysqli_error($mysqli));
    }
    return $filter_result;
}
?>

<!-- Inicio del contenido principal -->
<div class="container">
    <center>
        <h1>Ejecutivos de Cuentas</h1>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" type="button" href="Registration_Ejecutivo.php">Nuevo</a>
                <br><br>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>Número de Documento</th>
                                <th>Nombre Completo</th>
                                <th>Teléfono Personal</th>
                                <th>Correo Corporativo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Recorre los resultados de la consulta
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['Tipo_Documento']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Numero_Documento']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Nombre_Completo']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Telefono_Personal']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Correo_Corporativo']) . "</td>";
                                    echo "<td>
                                            <div class='text-center'>
                                                <div class='btn-group'>
                                                    <a class='btn btn-light' href='Edit_Ejecutivo.php?id=" . urlencode($row['ID_Ejecutivo_Cuentas']) . "'>Editar</a>
                                                    <a class='btn btn-danger btnBorrar' href='../BD/Delete_Ejecutivo.php?id=" . urlencode($row['ID_Ejecutivo_Cuentas']) . "'>Borrar</a>
                                                </div>
                                            </div>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay datos disponibles</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenido principal -->

<?php
require_once "vistas/parte_inferior.php";
?>
