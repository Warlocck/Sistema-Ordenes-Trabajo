<?php
include("../BD/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cotizacion = $_POST['ID_Cotizacion'];

    // Llamar al procedimiento almacenado para eliminar la cotización
    $delete_query = "CALL EliminarCotizacion('$id_cotizacion')";

    if (mysqli_query($mysqli, $delete_query)) {
        echo "<script>alert('Cotización eliminada exitosamente.'); window.location.href='../Fronted/Cotizacion.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la cotización: " . mysqli_error($mysqli) . "');</script>";
    }
}
?>
