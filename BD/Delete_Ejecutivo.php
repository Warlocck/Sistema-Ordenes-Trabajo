<?php
include("codigosw2.php");
include("config.php");
include("session.php");

if (isset($_GET['id'])) {
    $ID_Ejecutivo_Cuentas = $_GET['id'];

    $query = "CALL EliminarEjecutivo(?)";

    try {
        if ($stmt = $mysqli->prepare($query)) {

            $stmt->bind_param("s", $ID_Ejecutivo_Cuentas);
            if ($stmt->execute()) {
                echo '<script>';
                echo 'Swal.fire({';
                    echo '   icon: "success",';
                    echo '   title: "Ejecutivo de Cuentas Eliminado",';
                    echo '    showConfirmButton: false,';
                    echo '    timer: 1300';
                echo '}).then(function(result) {';
                echo 'window.location="../Fronted/Ejecutivos.php";';
                echo '});';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'Swal.fire({';
                    echo '   icon: "error",';
                    echo '   title: "Ejecutivo de Cuentas no eliminado",';
                    echo '   showConfirmButton: false,';
                    echo '   timer: 1300';
                echo '}).then(function(result) {';
                echo 'window.location="../Fronted/Ejecutivos.php";';
                echo '});';
                echo '</script>';
            }
    
            $stmt->close();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'Swal.fire({';
            echo '   icon: "error",';
            echo '   title: "Ejecutivo de Cuentas está en una Orden de Trabajo en este momento",';
            echo '   showConfirmButton: true,';
        echo '}).then(function(result) {';
        echo 'window.location="../Fronted/Ejecutivos.php";';
        echo '});';
        echo '</script>';
    }

    $mysqli->close();
} else {
    echo "ID de cliente no proporcionado.";
}
?>