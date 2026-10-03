<?php
include("codigosw2.php");
include("config.php");
include("session.php");

if (isset($_GET['id'])) {
    $Documento_Identidad = $_GET['id'];

    $query = "CALL EliminarCliente(?)";

    try {
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("s", $Documento_Identidad);
            if ($stmt->execute()) {
                // Verificar si se afectaron filas
                if ($stmt->affected_rows > 0) {
                    echo '<script>';
                    echo 'Swal.fire({';
                    echo '   icon: "success",';
                    echo '   title: "Cliente Eliminado",';
                    echo '   showConfirmButton: false,';
                    echo '   timer: 1300';
                    echo '}).then(function(result) {';
                    echo 'window.location="../Fronted/Clientes.php";';
                    echo '});';
                    echo '</script>';
                } else {
                    echo '<script>';
                    echo 'Swal.fire({';
                    echo '   icon: "error",';
                    echo '   title: "Cliente no eliminado",';
                    echo '   showConfirmButton: false,';
                    echo '   timer: 1300';
                    echo '}).then(function(result) {';
                    echo 'window.location="../Fronted/Clientes.php";';
                    echo '});';
                    echo '</script>';
                }
            }
        }
        $stmt->close();

    } catch (mysqli_sql_exception $e) {
        // Mostrar una alerta al usuario
        echo '<script>';
        echo 'Swal.fire({';
        echo '   icon: "error",';
        echo '   title: "Cliente está en una Orden de Trabajo en este momento",';
        echo '   showConfirmButton: true,';
        echo '}).then(function(result) {';
        echo 'window.location="../Fronted/Clientes.php";';
        echo '});';
        echo '</script>';
    }

    $mysqli->close();
} else {
    echo "ID de cliente no proporcionado.";
}
?>
