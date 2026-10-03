<?php
// Incluye los archivos necesarios
include("codigosw2.php"); // Archivos para funciones adicionales, si los tienes
include("config.php"); // Archivo de configuración de base de datos
include("session.php"); // Archivo para gestionar sesiones de usuario

// Verifica si se ha proporcionado un ID de orden
if (isset($_GET['id'])) {
    $ID_Orden_de_Trabajo = $_GET['id']; // Obtén el ID de la orden desde el parámetro GET

    // Procedimiento almacenado para eliminar la orden de trabajo
    $query = "CALL EliminarOrdenDeTrabajo(?)";

    // Prepara la consulta
    if ($stmt = $mysqli->prepare($query)) {
        // Vincula los parámetros
        $stmt->bind_param("s", $ID_Orden_de_Trabajo);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Mensaje de éxito con SweetAlert y redirección a la página anterior
            echo '<script>';
            echo 'Swal.fire({';
            echo '   icon: "success",';
            echo '   title: "Orden de Trabajo Eliminada",';
            echo '   showConfirmButton: false,';
            echo '   timer: 1300';
            echo '}).then(function(result) {';
            echo '   window.history.back();'; // Redirige a la página anterior
            echo '});';
            echo '</script>';
        } else {
            // Mensaje de error con SweetAlert y redirección a la página anterior
            echo '<script>';
            echo 'Swal.fire({';
            echo '   icon: "error",';
            echo '   title: "Orden no eliminada",';
            echo '   showConfirmButton: false,';
            echo '   timer: 1300';
            echo '}).then(function(result) {';
            echo '   window.history.back();'; // Redirige a la página anterior
            echo '});';
            echo '</script>';
        }

        // Cierra la declaración preparada
        $stmt->close();
    } else {
        // Manejo de errores en la preparación de la consulta
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    // Cierra la conexión
    $mysqli->close();
} else {
    // Mensaje si no se proporciona un ID válido
    echo '<script>';
    echo 'Swal.fire({';
    echo '   icon: "error",';
    echo '   title: "ID de Orden no proporcionado",';
    echo '   showConfirmButton: false,';
    echo '   timer: 1300';
    echo '}).then(function(result) {';
    echo '   window.history.back();'; // Redirige a la página anterior
    echo '});';
    echo '</script>';
}
?>
